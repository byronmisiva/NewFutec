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

	public function __construct(){
		parent::__construct();		
	}


    function get_table_by_champ($championship){

        $teams=$this->get_teams_total($championship)->result();
        $matches=$this->get_matches_by_champ($championship);
        $last_schedule=$this->get_last_schedule($championship);

        return $this->make_table($matches,$teams,$last_schedule);
    }

    function get_teams_total($championship){
        $this->db->select('t.id,t.name,s.id as section, t.short_name');
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

    function make_table($matches,$teams,$last_schedule){

        //TODO: Bonificacion en Tabla acumulada

        $table=array();

        foreach($teams as $row){
            $table[$row->id]=array('id'=>$row->id,'name'=>$row->name,'short_name'=>$row->short_name,'section'=>$row->section);
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