<?php
class Mdl_teams_position extends MY_Model{
	
	public $table_name = "teams";
	public $primary_key = "id";	
	public $joins;	
	public $select_fields;	
	public $total_rows;	
	public $page_links;	
	public $current_page;	
	public $num_pages;	
	public $optional_params;	
	public $order_by;	
	public $form_values = array();

    var $name;

	public function __construct(){
		parent::__construct();		
	}




    function get_active_round($id){
        $this->db->select('active_round as round');
        $this->db->from('championships');
        $this->db->where('id',$id);
        $data=current($this->db->get($this->name)->result());
        if($data->round==0){
            $this->db->select('rounds.id as round');
            $this->db->from('championships');
            $this->db->where('championship_id',$id);
            $this->db->order_by('priority','desc');
            $data=current($this->db->get('rounds')->result());
        }
        if(isset($data->round))
            return $data->round;
        else
            return false;
    }

    //desde grupos
    function get_by_round($round){
        $this->db->select("g.*,r.name as rname");
        $this->db->from('groups g');
        $this->db->join('rounds r', 'g.round_id = r.id');
        $this->db->where('g.round_id',$round);
        $this->db->order_by("g.name",'asc');
        return $this->db->get()->result();
    }

    //desde secciones
    function get_teams(){
        $this->db->select('id,team_id');
        $this->db->from('sections');
        $this->db->where('team_id >',0);
        $aux=$this->db->get($this->name);

        $res=array();
        foreach($aux->result() as $row){
            $res[$row->team_id]=$row->id;
        }

        return $res;
    }

    function get_teams_total($championship){
        $this->db->select('t.id,t.name,s.id as section, t.short_name, t.thumb_shield');
        $this->db->from('championships as c, championships_teams as ct, teams as t');
        $this->db->join('sections s', 't.id = s.team_id', 'left');
        $this->db->where('c.id','ct.championship_id',FALSE);
        $this->db->where('ct.team_id','t.id',FALSE);
        $this->db->where('c.id',$championship);
        $this->db->order_by('name','asc');

        $aux=$this->db->get();

        return $aux;
    }

    function get_last_schedule($champ){
        $this->db->where('id',$champ);
        $champ=current($this->db->get('championships')->result());
        $this->db->where('round_id',$champ->active_round);
        $this->db->where('round_id',178);
        $this->db->order_by('position','asc');
        $this->db->limit(1);
        $aux=current($this->db->get('schedules')->result());
        if($aux!=false)
            return $aux->id;
        else
            return false;
    }

    function get_matches_by_champ($champ){
        $this->db->select('m.*,mt.team_id_home as home,mt.team_id_away as away');
        $this->db->from('matches m,groups g, rounds r,matches_teams mt');
        $this->db->where('m.group_id','g.id',FALSE);
        $this->db->where('g.round_id','r.id',FALSE);
        $this->db->where('m.id','mt.match_id',FALSE);
        $this->db->where('r.championship_id',$champ);
        $this->db->where('m.state >','0');

        $aux=$this->db->get()->result();

        return $aux;
    }
    function get_table_by_champ($championship, $round = 0){

        $teams=$this->get_teams_total($championship)->result();
        $matches=$this->get_matches_by_champ($championship);
        $last_schedule=$this->get_last_schedule($championship);

        $result = $this->make_table($matches,$teams,$last_schedule);
        $teams = $this->sanciones_by_champ($result, $championship);

        return $teams;
    }

    function get_table_only($group  )
    {
        $query=$this->db->query('Select t.id, t.name, t.mini_shield,  if( s.id IS NULL , 0, s.id ) AS sid
                                 From (Select DISTINCT(t.id), t.name, t.mini_shield, g.name as group_name
                                         From groups as g, matches as m, matches_teams as mt, teams as t
                                         Where g.id='.$group.' AND g.id=m.group_id AND m.id=mt.match_id AND m.special=0 AND (mt.team_id_home=t.id or mt.team_id_away=t.id) ) as t
                                  Left Join sections as s ON t.id=s.team_id
                                  Order by t.name asc');
        return $query->result();
    }

    function get_table($group, $round = 0 )
    {


        $query=$this->db->query('Select t.*, if( s.id IS NULL , 0, s.id ) AS sid
                                 From (Select DISTINCT(t.id), t.name, t.mini_shield, g.name as group_name
                                         From groups as g, matches as m, matches_teams as mt, teams as t
                                         Where g.id='.$group.' AND g.id=m.group_id AND m.id=mt.match_id AND m.special=0 AND (mt.team_id_home=t.id or mt.team_id_away=t.id) ) as t
                                  Left Join sections as s ON t.id=s.team_id');

        $query2=$this->db->query('Select m.result, mt.team_id_home, mt.team_id_away, s.position
    							  From groups as g, matches as m, matches_teams as mt, schedules as s
    							  Where g.id='.$group.' AND g.id=m.group_id AND m.id=mt.match_id AND state!=0 AND m.special=0 AND m.schedule_id=s.id
    							  Order by s.position asc');

        $teams='';

        foreach($query->result() as $row):
            $teams[$row->id]['id']=$row->id;
            $teams[$row->id]['name']=$row->name;
            $teams[$row->id]['group_name']=$row->group_name;
            $teams[$row->id]['mini_shield']=$row->mini_shield;
            $teams[$row->id]['section']=$row->sid;
            $teams[$row->id]['points']=0;
            $teams[$row->id]['pj']=0;
            $teams[$row->id]['pg']=0;
            $teams[$row->id]['pe']=0;
            $teams[$row->id]['pp']=0;
            $teams[$row->id]['gf']=0;
            $teams[$row->id]['gc']=0;
            $teams[$row->id]['gd']=0;
            $teams[$row->id]['change']=1;
            $teams[$row->id]['updown']=0;
            $teams2[$row->id]['id']=$row->id;
            $teams2[$row->id]['points']=0;
            $teams2[$row->id]['gf']=0;
            $teams2[$row->id]['gc']=0;
            $teams2[$row->id]['gd']=0;
        endforeach;

        $last=$query2->row();
        if($last!=FALSE){
            $i=$last->position;
            $t=$this->special($group,$teams,$teams2,$i);
            $teams=$t;
            $teams2=$t;

        }

        foreach($query2->result() as $row):
            if($i!=$row->position){
                $i='';
            }
            if($row->result=="")
                $row->result="0 - 0";
            $result=explode('-',trim($row->result));

            $h=trim($result[0]);
            $a=trim($result[1]);

            if($h>$a){
                $teams[$row->team_id_home]['points']+=3;
                $teams[$row->team_id_home]['gf']+=$h;
                $teams[$row->team_id_home]['gc']+=$a;
                $teams[$row->team_id_home]['pg']+=1;

                $teams[$row->team_id_away]['gf']+=$a;
                $teams[$row->team_id_away]['gc']+=$h;
                $teams[$row->team_id_away]['pp']+=1;

                if($i==''){
                    $teams2[$row->team_id_home]['points']+=3;
                    $teams2[$row->team_id_home]['gf']+=$h;
                    $teams2[$row->team_id_home]['gc']+=$a;

                    $teams2[$row->team_id_away]['gf']+=$a;
                    $teams2[$row->team_id_away]['gc']+=$h;
                }

            }
            else{
                if($h==$a){
                    $teams[$row->team_id_home]['points']+=1;
                    $teams[$row->team_id_home]['gf']+=$h;
                    $teams[$row->team_id_home]['gc']+=$a;
                    $teams[$row->team_id_home]['pe']+=1;

                    $teams[$row->team_id_away]['points']+=1;
                    $teams[$row->team_id_away]['gf']+=$a;
                    $teams[$row->team_id_away]['gc']+=$h;
                    $teams[$row->team_id_away]['pe']+=1;

                    if($i==''){
                        $teams2[$row->team_id_home]['points']+=1;
                        $teams2[$row->team_id_home]['gf']+=$h;
                        $teams2[$row->team_id_home]['gc']+=$a;

                        $teams2[$row->team_id_away]['points']+=1;
                        $teams2[$row->team_id_away]['gf']+=$a;
                        $teams2[$row->team_id_away]['gc']+=$h;
                    }
                }
                else{
                    $teams[$row->team_id_away]['points']+=3;
                    $teams[$row->team_id_away]['gf']+=$a;
                    $teams[$row->team_id_away]['gc']+=$h;
                    $teams[$row->team_id_away]['pg']+=1;

                    $teams[$row->team_id_home]['gf']+=$h;
                    $teams[$row->team_id_home]['gc']+=$a;
                    $teams[$row->team_id_home]['pp']+=1;

                    if($i==''){
                        $teams2[$row->team_id_away]['points']+=3;
                        $teams2[$row->team_id_away]['gf']+=$a;
                        $teams2[$row->team_id_away]['gc']+=$h;

                        $teams2[$row->team_id_home]['gf']+=$h;
                        $teams2[$row->team_id_home]['gc']+=$a;
                    }
                }
            }

            $teams[$row->team_id_home]['pj']+=1;
            $teams[$row->team_id_away]['pj']+=1;

            $teams[$row->team_id_home]['gd']=$teams[$row->team_id_home]['gd']+$h-$a;
            $teams[$row->team_id_away]['gd']=$teams[$row->team_id_away]['gd']+$a-$h;
            if($i==''){
                $teams2[$row->team_id_home]['gd']=$teams2[$row->team_id_home]['gd']+$h-$a;
                $teams2[$row->team_id_away]['gd']=$teams2[$row->team_id_away]['gd']+$a-$h;
            }

        endforeach;

        $bonus=$this->get_bonus($group);

        if($bonus!=false){
            if($bonus->num_rows()>0){
                foreach($bonus->result() as $row):
                    if(isset($teams[$row->team_id]))
                        $teams[$row->team_id]['points']+=$row->bonus;
                endforeach;
            }
        }
        if(is_array($teams)){
            foreach ($teams as $key=>$arr):
                $pun[$key] = $arr['points'];
                $g1[$key] = $arr['gd'];
                $g2[$key] = $arr['gf'];
                $g3[$key] = $arr['gc'];
            endforeach;
            array_multisort($pun,SORT_DESC,$g1,SORT_DESC,$g2,SORT_DESC,$g3,SORT_ASC,$teams);

            foreach ($teams2 as $key2=>$arr2):
                $pun2[$key2] = $arr2['points'];
                $g21[$key2] = $arr2['gd'];
                $g22[$key2] = $arr2['gf'];
                $g23[$key2] = $arr2['gc'];
            endforeach;
            array_multisort($pun2,SORT_DESC,$g21,SORT_DESC,$g22,SORT_DESC,$g23,SORT_ASC,$teams2);

            $i=1;
            foreach($teams as $t):
                $j=1;

                foreach($teams2 as $t2):
                    if($t['id']==$t2['id']){
                        if($i>$j){
                            $teams[$i-1]['change']=2;
                            $teams[$i-1]['updown']=abs($i-$j);
                        }
                        if($i<$j){
                            $teams[$i-1]['change']=0;
                            $teams[$i-1]['updown']=abs($i-$j);
                        }
                    }
                    $j+=1;
                endforeach;

                $i+=1;
            endforeach;
        }

        $teams = $this->sanciones($teams, $round);
        return $teams;
    }

    function sanciones_by_champ  ($teams, $round) {
        //barcelona sancion campeonato 2015.
        if ($round == 53) {
            $teams = $this->sancionLDUL ($teams);
            $teams = $this->sancionLDUL ($teams);
            $teams = $this->sancionLDUL ($teams);
            $teams = $this->sancionLDUL ($teams);

            $teams = $this->sancionBarcelona ($teams);
            $teams = $this->sancionBarcelona ($teams);
            $teams = $this->sancionBarcelona ($teams);
            $teams = $this->sancionBarcelona ($teams);
            $teams = $this->sancionBarcelona ($teams);
            $teams = $this->sancionBarcelona ($teams);
            $teams = $this->sancionBarcelona ($teams);
            $teams = $this->sancionBarcelona ($teams);

            //sancion campeonato
            $teams = $this->sancionQuito ($teams, 8);

            $teams = $this->sancionNacional($teams, 1);

            $teams = $this->sancionOlmedo ($teams);
            $teams = $this->sancionQuevedo($teams);

        }
        //Reodenamos la tabla luego de disminuir puntos
        foreach ($teams as $key=>$arr):
            $pun[$key] = $arr['points'];
            $g1[$key] = $arr['gd'];
            $g2[$key] = $arr['gf'];
            $g3[$key] = $arr['gc'];
        endforeach;
        array_multisort($pun,SORT_DESC,$g1,SORT_DESC,$g2,SORT_DESC,$g3,SORT_ASC,$teams);
        return $teams;
    }
    function sanciones ($teams, $round) {

        //barcelona sancion campeonato 2015.
        if ($round == 196) {
            $teams = $this->sancionLDUL ($teams);
            $teams = $this->sancionLDUL ($teams);
            $teams = $this->sancionLDUL ($teams);

            $teams = $this->sancionBarcelona ($teams);
        }


        if ($round == 209) {
            $teams = $this->sancionLDUL($teams);
            $teams = $this->sancionBarcelona($teams);
            $teams = $this->sancionBarcelona($teams);
            $teams = $this->sancionBarcelona($teams);
            $teams = $this->sancionBarcelona($teams);
            $teams = $this->sancionBarcelona($teams);
            $teams = $this->sancionBarcelona($teams);
            $teams = $this->sancionBarcelona($teams);

            $teams = $this->sancionOlmedo($teams);
            $teams = $this->sancionQuevedo($teams);

            $teams = $this->sancionQuito($teams, 8);

            $teams = $this->sancionNacional($teams, 1);


        }
        //Reodenamos la tabla luego de disminuir puntos
        foreach ($teams as $key=>$arr):
            $pun[$key] = $arr['points'];
            $g1[$key] = $arr['gd'];
            $g2[$key] = $arr['gf'];
            $g3[$key] = $arr['gc'];
        endforeach;
        array_multisort($pun,SORT_DESC,$g1,SORT_DESC,$g2,SORT_DESC,$g3,SORT_ASC,$teams);
        return $teams;
    }

    public function sancionBarcelona ($tabla ) {
        foreach ($tabla as $key=>$equipo )
        {
            if ($equipo['id']== "34"){
                $tabla[$key]['points'] = $equipo['points'] - 1;
            }
        }
        return $tabla;
    }
    public function sancionQuito ($tabla, $puntos ) {
        foreach ($tabla as $key=>$equipo )
        {
            if ($equipo['id']== "36"){
                $tabla[$key]['points'] = $equipo['points'] - $puntos;
            }
        }
        return $tabla;
    }
    public function sancionNacional ($tabla, $puntos ) {
        foreach ($tabla as $key=>$equipo )
        {
            if ($equipo['id']== "15"){
                $tabla[$key]['points'] = $equipo['points'] - $puntos;
            }
        }
        return $tabla;
    }

    public function sancionLDUL ($tabla ) {
        foreach ($tabla as $key=>$equipo )
        {
            if ($equipo['id']== "77"){
                $tabla[$key]['points'] = $equipo['points'] - 1;
            }
        }
        return $tabla;
    }

    public function sancionQuevedo ($tabla ) {
        foreach ($tabla as $key=>$equipo )
        {
            if ($equipo['id']== "229"){
                $tabla[$key]['points'] = $equipo['points']- 1;
            }
        }
        return $tabla;
    }

    public function sancionOlmedo ($tabla ) {
        foreach ($tabla as $key=>$equipo )
        {
            if ($equipo['id']== "41"){
                $tabla[$key]['points'] = $equipo['points'] - 1;
            }
        }
        return $tabla;
    }


    function get_bonus($group){
        $row=$this->db->query('Select c.active_round as ar, r.id
    						   From championships as c, rounds as r, groups as g
    						   Where g.id='.$group.' and g.round_id= r.id and r.championship_id = c.id ')->result();

        $query=false;

        if($row[0]->ar==$row[0]->id){
            $query=$this->db->query('Select ct.team_id, ct.bonus
    								 From championships_teams as ct
    								 where ct.round_id='.$row[0]->ar);
        }
        return $query;
    }

    function special($group,$tabla,$tabla2,$i){
        $row=$this->db->query('Select g.round_id
    						   From groups as g
    						   Where g.id='.$group)->row();

        $row=$this->db->query('Select m.result, mt.team_id_home as th, mt.team_id_away as ta, s.position
    						   From groups as g, matches as m, matches_teams as mt, schedules as s
    						   Where g.round_id='.$row->round_id.' and g.id=m.group_id and m.special=1 and m.id=mt.match_id and m.schedule_id=s.id and m.state!=0');

        foreach($row->result() as $r):
            $result=explode('-',trim($r->result));
            $h=trim($result[0]);
            $a=trim($result[1]);
            if($h>$a){
                if(isset($tabla[$r->th])){
                    $tabla[$r->th]['points']+=3;
                    $tabla[$r->th]['gf']+=$h;
                    $tabla[$r->th]['gc']+=$a;
                    $tabla[$r->th]['pg']+=1;
                    $tabla[$r->th]['pj']+=1;
                    $tabla[$r->th]['gd']=$tabla[$r->th]['gd']+$h-$a;

                    if($i!=$r->position){
                        $tabla2[$r->th]['points']+=3;
                        $tabla2[$r->th]['gf']+=$h;
                        $tabla2[$r->th]['gc']+=$a;
                        $tabla2[$r->th]['gd']=$tabla2[$r->th]['gd']+$h-$a;
                    }
                }
                if(isset($tabla[$r->ta])){
                    $tabla[$r->ta]['gf']+=$a;
                    $tabla[$r->ta]['gc']+=$h;
                    $tabla[$r->ta]['pp']+=1;
                    $tabla[$r->ta]['pj']+=1;
                    $tabla[$r->ta]['gd']=$tabla[$r->ta]['gd']+$a-$h;

                    if($i!=$r->position){
                        $tabla2[$r->ta]['gf']+=$a;
                        $tabla2[$r->ta]['gc']+=$h;
                        $tabla2[$r->ta]['gd']=$tabla2[$r->ta]['gd']+$a-$h;
                    }
                }
            }

            if($h==$a){
                if(isset($tabla[$r->th])){
                    $tabla[$r->th]['points']+=1;
                    $tabla[$r->th]['gf']+=$h;
                    $tabla[$r->th]['gc']+=$a;
                    $tabla[$r->th]['pe']+=1;
                    $tabla[$r->th]['pj']+=1;
                    $tabla[$r->th]['gd']=$tabla[$r->th]['gd']+$h-$a;

                    if($i!=$r->position){
                        $tabla2[$r->th]['points']+=1;
                        $tabla2[$r->th]['gf']+=$h;
                        $tabla2[$r->th]['gc']+=$a;
                        $tabla2[$r->th]['gd']=$tabla2[$r->th]['gd']+$h-$a;
                    }
                }
                if(isset($tabla[$r->ta])){
                    $tabla[$r->ta]['points']+=1;
                    $tabla[$r->ta]['gf']+=$a;
                    $tabla[$r->ta]['gc']+=$h;
                    $tabla[$r->ta]['pe']+=1;
                    $tabla[$r->ta]['pj']+=1;
                    $tabla[$r->ta]['gd']=$tabla[$r->ta]['gd']+$a-$h;
                    if($i!=$r->position){
                        $tabla2[$r->ta]['points']+=1;
                        $tabla2[$r->ta]['gf']+=$a;
                        $tabla2[$r->ta]['gc']+=$h;
                        $tabla2[$r->ta]['gd']=$tabla2[$r->ta]['gd']+$a-$h;
                    }
                }

            }
            if($h<$a){
                if(isset($tabla[$r->ta])){
                    $tabla[$r->ta]['points']+=3;
                    $tabla[$r->ta]['gf']+=$a;
                    $tabla[$r->ta]['gc']+=$h;
                    $tabla[$r->ta]['pg']+=1;
                    $tabla[$r->ta]['pj']+=1;
                    $tabla[$r->ta]['gd']=$tabla[$r->ta]['gd']+$a-$h;

                    if($i!=$r->position){
                        $tabla2[$r->ta]['points']+=3;
                        $tabla2[$r->ta]['gf']+=$a;
                        $tabla2[$r->ta]['gc']+=$h;
                        $tabla2[$r->ta]['gd']=$tabla2[$r->ta]['gd']+$a-$h;
                    }
                }
                if(isset($tabla[$r->th])){
                    $tabla[$r->th]['gf']+=$h;
                    $tabla[$r->th]['gc']+=$a;
                    $tabla[$r->th]['pp']+=1;
                    $tabla[$r->th]['pj']+=1;
                    $tabla[$r->th]['gd']=$tabla[$r->th]['gd']+$h-$a;
                    if($i!=$r->position){
                        $tabla2[$r->th]['gf']+=$h;
                        $tabla2[$r->th]['gc']+=$a;
                        $tabla2[$r->th]['gd']=$tabla2[$r->th]['gd']+$h-$a;
                    }
                }
            }

        endforeach;

        //var_dump($tabla);

        return $tabla;
    }


    function make_table($matches,$teams,$last_schedule){

        //TODO: Bonificacion en Tabla Acumulada

        $table=array();

        foreach($teams as $row){
            $table[$row->id]=array('id'=>$row->id,'name'=>$row->name,'thumb_shield'=>$row->thumb_shield,'short_name'=>$row->short_name,'section'=>$row->section);
            $table[$row->id]['points']=0;
            $table[$row->id]['pj']=0;
            $table[$row->id]['pg']=0;
            $table[$row->id]['pe']=0;
            $table[$row->id]['pp']=0;
            $table[$row->id]['gf']=0;
            $table[$row->id]['gc']=0;
            $table[$row->id]['gd']=0;
            $table[$row->id]['change']=1;
            $table[$row->id]['updown']=0;
        }
        $table_ant=$table;

        foreach($matches as $row){
            $home=false;
            $away=false;
            $result=trim($row->result);
            $h=(int)trim(substr($result,0,1));
            $a=(int)trim(substr($result,3));

            if(isset($table[$row->home])){
                $table[$row->home]['pj']+=1;
                $home=true;
                if($row->schedule_id!=$last_schedule)
                    $table_ant[$row->home]['pj']+=1;
            }
            if(isset($table[$row->away])){
                $table[$row->away]['pj']+=1;
                $away=true;
                if($row->schedule_id!=$last_schedule)
                    $table_ant[$row->away]['pj']+=1;
            }

            //Si el equipo local gana
            if($h>$a){
                if($home){
                    $table[$row->home]['points']+=3;
                    $table[$row->home]['pg']+=1;
                    $table[$row->home]['gf']+=$h;
                    $table[$row->home]['gc']+=$a;
                    $table[$row->home]['gd']+=$h-$a;
                    if($row->schedule_id!=$last_schedule){
                        $table_ant[$row->home]['points']+=3;
                        $table_ant[$row->home]['pg']+=1;
                        $table_ant[$row->home]['gf']+=$h;
                        $table_ant[$row->home]['gc']+=$a;
                        $table_ant[$row->home]['gd']+=$h-$a;
                    }
                }
                if($away){
                    $table[$row->away]['pp']+=1;
                    $table[$row->away]['gf']+=$a;
                    $table[$row->away]['gc']+=$h;
                    $table[$row->away]['gd']+=$a-$h;
                    if($row->schedule_id!=$last_schedule){
                        $table_ant[$row->away]['pp']+=1;
                        $table_ant[$row->away]['gf']+=$a;
                        $table_ant[$row->away]['gc']+=$h;
                        $table_ant[$row->away]['gd']+=$a-$h;
                    }
                }
            }
            else{
                //Si Empatan
                if($h==$a){
                    if($home){
                        $table[$row->home]['points']+=1;
                        $table[$row->home]['pe']+=1;
                        $table[$row->home]['gf']+=$h;
                        $table[$row->home]['gc']+=$a;
                        if($row->schedule_id!=$last_schedule){
                            $table_ant[$row->home]['points']+=1;
                            $table_ant[$row->home]['pe']+=1;
                            $table_ant[$row->home]['gf']+=$h;
                            $table_ant[$row->home]['gc']+=$a;
                        }
                    }
                    if($away){
                        $table[$row->away]['points']+=1;
                        $table[$row->away]['pe']+=1;
                        $table[$row->away]['gf']+=$a;
                        $table[$row->away]['gc']+=$h;
                        if($row->schedule_id!=$last_schedule){
                            $table_ant[$row->away]['points']+=1;
                            $table_ant[$row->away]['pe']+=1;
                            $table_ant[$row->away]['gf']+=$a;
                            $table_ant[$row->away]['gc']+=$h;
                        }
                    }
                }
                //Si el Equipo visitante gana
                else{
                    if($home){
                        $table[$row->home]['pp']+=1;
                        $table[$row->home]['gf']+=$h;
                        $table[$row->home]['gc']+=$a;
                        $table[$row->home]['gd']+=$h-$a;
                        if($row->schedule_id!=$last_schedule){
                            $table_ant[$row->home]['pp']+=1;
                            $table_ant[$row->home]['gf']+=$h;
                            $table_ant[$row->home]['gc']+=$a;
                            $table_ant[$row->home]['gd']+=$h-$a;
                        }
                    }
                    if($away){
                        $table[$row->away]['points']+=3;
                        $table[$row->away]['pg']+=1;
                        $table[$row->away]['gf']+=$a;
                        $table[$row->away]['gc']+=$h;
                        $table[$row->away]['gd']+=$a-$h;
                        if($row->schedule_id!=$last_schedule){
                            $table_ant[$row->away]['points']+=3;
                            $table_ant[$row->away]['pg']+=1;
                            $table_ant[$row->away]['gf']+=$a;
                            $table_ant[$row->away]['gc']+=$h;
                            $table_ant[$row->away]['gd']+=$a-$h;
                        }
                    }
                }
            }
        }

        //Ordeno las dos tablas generadas
        foreach ($table as $key=>$arr):
            $pun[$key] = $arr['points'];
            $g1[$key] = $arr['gd'];
            $g2[$key] = $arr['gf'];
            $g3[$key] = $arr['gc'];
        endforeach;

        array_multisort($pun,SORT_DESC,$g1,SORT_DESC,$g2,SORT_DESC,$g3,SORT_ASC,$table);

        $pun=$g1=$g2=$g3=array();
        foreach ($table_ant as $key=>$arr):
            $pun[$key] = $arr['points'];
            $g1[$key] = $arr['gd'];
            $g2[$key] = $arr['gf'];
            $g3[$key] = $arr['gc'];
        endforeach;

        array_multisort($pun,SORT_DESC,$g1,SORT_DESC,$g2,SORT_DESC,$g3,SORT_ASC,$table_ant);

        //Reviso posiciones con la ultima fecha y cuanto se han movido
        foreach($table as $key=>$row){
            foreach($table_ant as $key2=>$row2){
                if($row['id']==$row2['id']){
                    if($key>$key2){
                        $table[$key]['change']=2;
                        $table[$key]['updown']=abs($key-$key2);
                    }
                    if($key<$key2){
                        $table[$key]['change']=0;
                        $table[$key]['updown']=abs($key-$key2);
                    }
                }
            }
        }

        return $table;
    }

}