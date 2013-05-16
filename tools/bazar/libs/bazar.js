$(document).ready(function () {
	//carto google
	var divcarto = document.getElementById("map" )
	if (divcarto) {	initialize(); }
	// clic sur le lien d'une fiche, l'ouvre sur la carto
	$("#markers a").live("click", function(){
		var i = $(this).attr("rel");
		// this next line closes all open infowindows before opening the selected one
		for(x=0; x < arrInfoWindows.length; x++){ arrInfoWindows[x].close(); }
		arrInfoWindows[i].open(map, arrMarkers[i]);
		$('ul.css-tabs li').remove();
		$("fieldset.tab").each(function(i) {
						$(this).parent('div.BAZ_cadre_fiche').prev('ul.css-tabs').append("<li class='liste" + i + "'><a href=\"#\">"+$(this).find('legend:first').hide().html()+"</a></li>");
		});
		$("ul.css-tabs").tabs("fieldset.tab", { onClick: function(){} } );
	});

	//tabulations (transforme les fieldsets de classe tab en tabulation)
	$(".BAZ_cadre_fiche, #formulaire").each(function() {
		//nb de tabs par fiche
		var nbtotal = $(this).children("fieldset.tab").size() - 1;
		
		//on ajoute le nom des tabs à partir de la legende du fieldset
		$(this).children("fieldset.tab:first").before("<ul class='css-tabs'></ul>");
		$(this).children("fieldset.tab").each(function(i) {
			$(this).addClass("tab" + i)
            if (nbtotal!=0)
            {
                if (i==0)
                {
                    $(this).append('<a class="btn next" onClick=\'$(this).parents("fieldset.tab").prevAll("ul.css-tabs").tabs('+i+').next();\'>Suivant &raquo;</a>');
                }
                else if (i==nbtotal)
                {
                    $(this).append('<a class="btn prev" onClick=\'$(this).parents("fieldset.tab").prevAll("ul.css-tabs").tabs('+i+').prev();\'>&laquo; Pr&eacute;c&eacute;dent</a>');
                }
                else
                {
                    $(this).append('<a class="btn prev" onClick=\'$(this).parents("fieldset.tab").prevAll("ul.css-tabs").tabs('+i+').prev();\'>&laquo; Pr&eacute;c&eacute;dent</a><a class="btn next" onClick=\'$(this).parents("fieldset.tab").prevAll("ul.css-tabs").tabs('+i+').next();\'>Suivant &raquo;</a>');
                }
            }
			$(this).prevAll('ul.css-tabs').append("<li class='liste" + i + "'><a href=\"#\">"+$(this).find('legend:first').hide().html()+"</a></li>");
		});
	});
	//initialise tabulations
	if ($("ul.css-tabs").size() > 1)
	{
		$("ul.css-tabs").tabs("> .tab", { onClick: function(){if (divcarto) {	initialize(); }} } );
	} 
	else
	{
		$("ul.css-tabs").tabs("fieldset.tab", { onClick: function(){if (divcarto) {	initialize(); }} } );
	}
	
	
	
	//création des div pour jquery tools (tooltips, overlays, etc..)
    $("body").append("<div id=\"dynatooltip\">&nbsp;</div><div class=\"overlay\" id=\"overlay\"><div class=\"contentWrap\"></div></div><div class=\"simple_overlay\" id=\"gallery\"><a class=\"prev\">Pr&eacute;c&eacute;dent</a><a class=\"next\">Suivant</a><div class=\"info\"></div><img class=\"progress\" src=\"tools/bazar/presentation/images/ajax-loader.gif\" /></div>");

    // initialise les tooltips d'aide
    $("img.tooltip_aide[title]").tooltip('#dynatooltip');
    
	//accordeon pour bazarliste
	$(".accordion h2.titre_accordeon").bind('click',function() {
		$(this).next("div.pane").slideToggle('fast');
		if ($(this).hasClass('current')) {
			$(this).removeClass('current');
		} else { 
			$(this).addClass('current');
		}
	});
	

    // initialise les iframe en overlay
    $("a.ouvrir_overlay[rel]").overlay({
		expose:			'black',
		effect:			'apple',
		oneInstance:	true,
		closeOnClick:	false,
		onBeforeLoad: function() {
			//on transforme le lien avecle handler /iframe, pour le charger dans une fenetre overlay
			var overlay_encours = this
			var lien = overlay_encours.getTrigger().attr("href");
			result = lien.match(/\/iframe/i); 
			if (!result) { lien = lien.replace(/wiki=([a-z0-9]+)&/ig, 'wiki=$1/iframe&', 'g'); }
			$("#overlay div.contentWrap").html('<iframe class="wikiframe" width="630" height="480" frameborder="0" src="' + lien + '"></iframe>');
			//dans la frame, on change le fonctionnement des boutons annuler et sauver, pour retourner comme il faut dans la page de modification principale
			var myFrame = $('#overlay .wikiframe');
			myFrame.load(function() { 
				var contenu_iframe = myFrame.contents();
				contenu_iframe.find('.bouton_annuler').click(function(event) {
					event.preventDefault();
					overlay_encours.close(); 
					return false;
				});
				contenu_iframe.find('input.bouton_sauver').click(function(event) {
					//event.preventDefault();
					//return false;
				});
			});
			
		}		
	});

	//liste oui / non conditionnelle
	$("select[id^='liste25'], select[id^='liste26']").change( function() {
		if ($(this).val()==1) {
			$(this).parents(".formulaire_ligne").next("div[id^='oui']").show();
			$(this).parents(".formulaire_ligne").next("div[id^='non']").hide();
		}
		if ($(this).val()==2) {
			$(this).parents(".formulaire_ligne").next("div[id^='non']").show();
			$(this).parents(".formulaire_ligne").next("div[id^='oui']").hide();
		}
	});
	//a l'ouverture du formulaire, on affiche 
	$(".BAZ_cadre_fiche div[id^='oui'], .BAZ_cadre_fiche div[id^='non']").show();
	$("#formulaire select[id^='liste25'], #formulaire select[id^='liste26']").each(function() {
		if ($(this).val()==1) {
			$(this).parents(".formulaire_ligne").next("div[id^='oui']").show();
			$(this).parents(".formulaire_ligne").next("div[id^='non']").hide();
		}
		if ($(this).val()==2) {
			$(this).parents(".formulaire_ligne").next("div[id^='non']").show();
			$(this).parents(".formulaire_ligne").next("div[id^='oui']").hide();
		}
	});

	//on enleve la fonction doubleclic dans le cas d'une page contenant bazar
	$("div[ondblclick]").removeAttr("ondblclick");

	//affichage tooltip des evenements dans le calendrier
	$('.date_avec_evenements').each(function () {
		// options
		var distance = 10;
		var time = 250;
		var hideDelay = 100;

		var hideDelayTimer = null;

		// tracker
		var beingShown = false;
		var shown = false;

		var trigger = $(this);
		var popup = $('.evenements ul', this).css('opacity', 0);

		// set the mouseover and mouseout on both element
		$([trigger.get(0), popup.get(0)]).mouseover(function () {
			$(this).addClass('date_hover');
			// stops the hide event if we move from the trigger to the popup element
			if (hideDelayTimer) clearTimeout(hideDelayTimer);

			// don't trigger the animation again if we're being shown, or already visible
			if (beingShown || shown) {
				return;
			} else {
				beingShown = true;

				// reset position of popup box
				popup.css({
					bottom: 20,
					left: -76,
					display: 'block' // brings the popup back in to view
				})

				// (we're using chaining on the popup) now animate it's opacity and position
				.animate({
					bottom: '+=' + distance + 'px',
					opacity: 1
				}, time, 'swing', function() {
					// once the animation is complete, set the tracker variables
					beingShown = false;
					shown = true;
				});
			}
		}).mouseout(function () {
			$(this).removeClass('date_hover');
			// reset the timer if we get fired again - avoids double animations
			if (hideDelayTimer) clearTimeout(hideDelayTimer);

			// store the timer so that it can be cleared in the mouseover if required
			hideDelayTimer = setTimeout(function () {
				hideDelayTimer = null;
				popup.animate({
					bottom: '-=' + distance + 'px',
					opacity: 0
				}, time, 'swing', function () {
					// once the animate is complete, set the tracker variables
					shown = false;
					// hide the popup entirely after the effect (opacity alone doesn't do the job)
					popup.css('display', 'none');
				});
			}, hideDelay);
		});
	});

//=====================galerie d'images===================================================================
	var imagespourgalerie = $("a.triggerimage");
	if (imagespourgalerie.length > 0) {	
		imagespourgalerie.overlay({ target:'#gallery', expose:'#f1f1f1' }).gallery({ speed:500 });
	}
	
//============bidouille pour que les widgets en flash restent en dessous des éléments en survol===========
	$("object").append('<param value="opaque" name="wmode">');$("embed").attr('wmode','opaque');

});

//fonction pour faire des polygones
function createPolygon(coords, color) {
		return new google.maps.Polygon({
			paths: coords,
			strokeColor: "black",
			strokeOpacity: 0.8,
			strokeWeight: 1,
			fillColor: color,
			fillOpacity: 0.4
		});
}

