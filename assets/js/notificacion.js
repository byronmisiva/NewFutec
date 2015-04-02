var extensionId = "cjkoikfgconobaeikllfnkpnjihcfnil";
function instalarExtension() {
    chrome.webstore.install("https://chrome.google.com/webstore/detail/cjkoikfgconobaeikllfnkpnjihcfnil", function () {
        $(".fondo-notificaciones").animate({
            height: "0"
        }, 300, "linear", function () {
            $(".logochr").hide();
        });
    });
}


$(function () {
    // Activate Chrome Web Store inline installations.
    var chrome = window.chrome || {};
    if (chrome.app && chrome.webstore) {
        $('.chrome_install_button').on('click.chrome', function () {
            var $this = $(this);
            if (!$this.hasClass('chrome_install_button')) {
                $this.off('.chrome');
                return;
            }
            chrome.webstore.install($this.attr('href'), function () {
                $this.toggleClass('chrome_install_button disabled').off('.chrome');
                $(".fondo-notificaciones").animate({
                    height: "0"
                }, 1000, "linear", function () {
                    $(".logochr").show();
                });
            });
            return false;
        });
    }

});

function verificarInstlacion() {
    var is_chrome = navigator.userAgent.toLowerCase().indexOf('chrome') > -1;
    if (is_chrome) {
        if ($(".fe_notificacion").length > 0) {
//	        $('#install-button').hide();
            //   $( ".fondo-notificaciones" ).show();
            $(".fondo-notificaciones").animate({
                height: "0"
            }, 300, "linear", function () {
                $(".logochr").hide();
            });

        } else {
            $(".fondo-notificaciones").animate({
                height: "35px"
            }, 300, "linear", function () {
                $(".logochr").show();
            });
        }
    }
}

setTimeout(function () {
    if (verMobile == 0) {
        verificarInstlacion();
    }
}, 5000);

