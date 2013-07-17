function fKeyDown() {
    if (event.keyCode == 9) {
        event.returnValue= false;
        document.selection.createRange().text = String.fromCharCode(9);
    }
}

$(window).load(function (){
    
    // A la modification, affichage des zones "pliées" si un champ n'est pas vide(donc rempli)
    // Fiche Informations générales -> Etablissement -> ajouter d'autres sites
    // Fiche Structures -> Réseaux
    // input2check [prefixe, suffixe, numerotation, id à déplier, id div à afficher]
  var input2check = [
                        ["bf_titre_nom_site", "", [1,2,3,4], "adresse_site", "adresse_etablissement_site"],
                        ["bf_reseaux_reseau", "_nom", [2,3,4,5,7,8,9,10], "reseau", "div_reseau"],
                    ];
        for (var i = 0; i < input2check.length; i++) {
            var prefixe  = input2check[i][0];
            var suffixe = input2check[i][1];
            var numero = input2check[i][2];
            var id2unfold = input2check[i][3];
            var div2show = input2check[i][4];
            for (var j = 0; j < numero.length; j++) {
            	if($("#" + prefixe + numero[j] + suffixe).val() !== ''){
                    $("#" + id2unfold + numero[j]).removeClass().addClass("plier");
                    $("#" + div2show + numero[j]).show();
                }
            }
        }

    // Affichage des champs textes si la case correspondante est cochée [liste à 1 élément]
        var divs_txt_checkbox = [
                                    /*Collections HN*/
                                    [[43,54,57,60], "col_sc_nat"],
                                    [[44,53], "botanique-mycologie"],
                                    [[55,56], "geologie"],
                                    [[58,59,44,102], "paleontologie"],
                                    [[58,59], "zoologie"],
                                    [[45,47,48,49], "botanique"],
                                    [[48,49,101], "mycologie"],
                                    [[61,68,69,70], "vertebres"],
                                    [[62,63,64], "mammalogie"],
                                    [[62,63,64,104,105], "ornithologie"],
                                    [[62,63,64], "herpethologie"],
                                    [[62,63,64], "ichtyologie"],
                                    [[71,74,76], "invertebres"],
                                    [[72,64], "entomologie"],
                                    [[75,64], "malacologie"],
                                    [[77,64], "autres_invertebres"],
                                    /*Autres collections du musée*/
                                    [[78,91], "autres_col"],                      
                                    [[79,80,84,88,89,90,106,107], "scientifiques"],
                                    [[81,82,83], "archeo"],
                                    [[85,86,87], "ethno-anthropo"],
                                    [[92,93], "culturelles"],
                                    /*Types*/
                                    [[44,54], "types_disciplines"],
                                    [[60], "types_disciplines", "types_zoologie"],
                                    [[57], "types_disciplines", "types_paleo"],
                                    [[58], "types_zoologie", "types_zoologie_vertebres"],
                                    [[59], "types_zoologie", "types_zoologie_invertebres"],
                                    [[61,68,69,70], "types_vertebres"],
                                    [[71,74], "types_invertebres"],
                                    [[58,59,44], "types_paleo"],
                                    /*Figurés*/
                                    [[44,54], "figures_disciplines"],
                                    [[60], "figures_disciplines", "figures_zoologie"],
                                    [[57], "figures_disciplines", "figures_paleo"],
                                    [[58], "figures_zoologie", "figures_zoologie_vertebres"],
                                    [[59], "figures_zoologie", "figures_zoologie_invertebres"],
                                    [[61,68,69,70], "figures_vertebres"],
                                    [[71,74], "figures_invertebres"],
                                    [[58,59,44], "figures_paleo"],
                                    /*Disparus*/
                                    [[44], "disparus_disciplines"],
                                    [[60], "disparus_disciplines", "disparus_zoologie"],                                    
                                    [[58], "disparus_zoologie", "disparus_zoologie_vertebres"],
                                    [[59], "disparus_zoologie", "disparus_zoologie_invertebres"],
                                    [[61,68,69,70], "disparus_vertebres"],
                                    [[71,74], "disparus_invertebres"],
                                    /* Provenance géographique des collections */
                                    [[161], "bf_provenance_region", "div_bf_provenance_region"],
                                    [[162], "bf_provenance_france", "div_bf_provenance_france"],
                                    [[163], "bf_provenance_europe", "div_bf_provenance_europe"],
                                    [[164], "bf_provenance_monde", "div_bf_provenance_monde"],
                                    /*consultations scientifiques*/
                                    [[44], "bf_types_consultations_botanique_2010", "div_types_consultations_botanique_2010"],
                                    [[44], "bf_types_consultations_botanique_2011", "div_types_consultations_botanique_2011"],
                                    [[60], "bf_types_consultations_zoologie_2010", "div_types_consultations_zoologie_2010"],
                                    [[60], "bf_types_consultations_zoologie_2011", "div_types_consultations_zoologie_2011"],
                                    [[54], "bf_types_consultations_geologie_2010", "div_types_consultations_geologie_2010"],
                                    [[54], "bf_types_consultations_geologie_2011", "div_types_consultations_geologie_2011"],
                                    [[57], "bf_types_consultations_paleontologie_2010", "div_types_consultations_paleontologie_2010"],
                                    [[57], "bf_types_consultations_paleontologie_2011", "div_types_consultations_paleontologie_2011"],
                                    /*Espaces et équipements spécifiques*/
                                    //checkbox138bf_types_espaces_espaces_exposition[1]
                                    [[138], "bf_types_espaces_espaces_exposition", "div_espaces_exposition"],
                                    [[139], "bf_types_espaces_permanents"],
                                    [[140], "bf_types_espaces_consacres"],
                                    [[141], "bf_types_espaces_temporaires"],
                                    [[143], "bf_types_espaces_dedies_vivant", "div_espaces_dedies_vivant"],
                                    [[144], "bf_types_espaces_conservation", "div_espaces_conservation"],
                                    [[146], "bf_types_espaces_conservation_scnat"],
                                    [[147], "bf_types_espaces_conservation_insitu"],
                                    [[148], "bf_types_espaces_conservation_exsitu"],
                                    [[149], "bf_types_espaces_mediation"],
                                    [[150], "bf_types_espaces_accueil"],
                                    [[151], "bf_types_espaces_commerciaux"],
                                    [[152], "bf_types_espaces_travail"],
                                    [[168], "bf_types_espaces_techniques"],
                                    [[153], "bf_types_espaces_agrement"],
                                    [[50], "bf_types_espaces_autre"],
                                    [[154], "bf_types_equipements_auditorium"],
                                    [[155], "bf_types_equipements_bibliotheque"],
                                    [[50], "bf_types_equipements_autre"],
                               ];
            for (var i = 0; i < divs_txt_checkbox.length; i++) {
                var tab_num  = divs_txt_checkbox[i][0];
                var tab_name = divs_txt_checkbox[i][1];
                var tab_id = divs_txt_checkbox[i][2];
                for (var j = 0; j < tab_num.length; j++) {	
                    if($("input[name='checkbox" +tab_num[j]+tab_name+ "[1]']").is(':checked')) {
                        $("#checkbox" +tab_num[j]+tab_name).show();
                        $("#" + tab_id).show();
                    }
                }
            }
            
    // Affichage des champs textes si la case correspondante est cochée [liste à plusieurs éléments]
        var divs_txt_checkboxs = [
                                    /*Activités en ligne*/
                                    [173, "bf_web_site", [2,3], "div_web_site"],
                                    [171, "bf_web_publications", [2], "div_newsletter"],
                                    /*Accès personnes handicappées*/
                                    [176, "bf_label_tourisme_handicap_choix", [1,2,3,4]],
                                ];
            for (var i = 0; i < divs_txt_checkboxs.length; i++) {
                var numliste  = divs_txt_checkboxs[i][0];
                var name = divs_txt_checkboxs[i][1];
                var tab_options = divs_txt_checkboxs[i][2];
                var divname = divs_txt_checkboxs[i][3];
                for (var j = 0; j < tab_options.length; j++) {	
                    if($("input[name='checkbox" + numliste + name + "[" + tab_options[j] + "]']").is(':checked')) {
                        $("#checkbox" + numliste + name + tab_options[j]).show();
                        $("#" + divname).show();
                    }
                }
            }        
                                
	
	//Affichage des champs textes pour les checkboxs autre (modification d'une fiche existante)
    //array = [nom du champ input, gestion des années (1=oui)]
		var aff_autre = [
                         ["botanique"],
						 ["mycologie"],
						 ["mammalogie"],
						 ["ornithologie"],
						 ["herpethologie"],
						 ["ichtyologie"],
						 ["malacologie"],
						 ["entomologie"],
						 ["autres_invertebres"],
						 ["archeo"],
						 ["scientifiques"],
						 ["culturelles"],
                         //["types_vertebres"],
                         ["types_invertebres"],
                         //["figures_vertebres"],
                         ["figures_invertebres"],
                         //["disparus_vertebres"],
                         ["disparus_invertebres"],
                         ["bf_types_consultations_botanique_autre_", 1],
                         ["bf_types_consultations_zoologie_autre_", 1],
                         ["bf_types_consultations_geologie_autre_", 1],
                         ["bf_types_consultations_paleontologie_autre_", 1],
                         ["bf_types_consultations_autre_", 1],
                         ["bf_types_espaces_autre"],
                         ["bf_types_equipements_autre"],
                        ];
        currentYear = (new Date).getFullYear();                 
            for (var i = 0; i < aff_autre.length; i++) {
                if (aff_autre[i][1] !== 'undefined' && 	aff_autre[i][1] === 1) {
                    for (var year = 2010; year <= currentYear; year++) {
                        if($("input[name='checkbox50" + aff_autre[i][0] + year + "[1]']").is(':checked')) {
                            $("#checkbox50" + aff_autre[i][0] + year + "1autre").parent().show();
                            $("#checkbox50" + aff_autre[i][0] + year).show();
                        }
                    }
                } else {
                    if($("input[name='checkbox50" + aff_autre[i][0] + "[1]']").is(':checked')) {
                            $("#checkbox50" + aff_autre[i][0] + "1autre").parent().show();
                            $("#checkbox50" + aff_autre[i][0]).show();
                    }    
                }            
            }
		
        
     /*
     *  Action : Affichage conditionnel dans les checkboxs - Affichage des classes correspondantes
     *          Collections > Inventaire et récolement > Avancement (conditionnel) "par type de discipline cochée précédemment"
     *  Onglet : Collection
     *  Question : inventaire informatisé et récolement
     * 
     */
	var tab_ckbox = [
                       ['checkbox43col_sc_nat[1]','classe_avancement_fiches_saisies_botamyco'],
                       ['checkbox54col_sc_nat[1]','classe_avancement_fiches_saisies_geologie'],
                       ['checkbox57col_sc_nat[1]','classe_avancement_fiches_saisies_paleo'],
                       ['checkbox58zoologie[1]','classe_avancement_fiches_saisies_zoovertebres'],
                       ['checkbox59zoologie[1]','classe_avancement_fiches_saisies_zooinvertebres'],
                       ['checkbox80scientifiques[1]','classe_avancement_fiches_saisies_archeo'],
                       ['checkbox84scientifiques[1]','classe_avancement_fiches_saisies_ethno'],
                    ],
        id ='';             
	for (var i = 0; i<tab_ckbox.length; i++) {
        if($("input[name='" + tab_ckbox[i][0] + "']").is(':checked')) {
            $("." + tab_ckbox[i][1]).show();
        }
    }
        
        
        
		//Affichage des checkboxs cachées si checkbox cochée + champs "autres", autres que "checkbox50"
        var tab_chkbx = [
                         /*Mode de comptage*/   
                         [36, 1 , [2,3]],
                         [36, 4 , [5,6]],
                         [36, 8 , ["autre8"]],
                         /*Activités en ligne*/
                         ['170bf_web_reseaux_sociaux',5, ['autre5']],
                         ['171bf_web_publications',3,['autre3']],
                         /*Statut administratif*/
                         [24, 16, ['autre16']],
                         [24, 21, ['autre21']],
                         [24, 27, ['autre27']],
                         [24, 37, ['autre37']],
                         /*Tarification*/
                         ['181bf_offres_tarifaires_2010',3, ['autre3']], 
                         ['181bf_offres_tarifaires_2011',3, ['autre3']],   
                         /*Budget*/
                         ['37subvention_2010', 14, ['autre14']],
                         ['37subvention_2011', 14, ['autre14']],
                         ['37subvention_2010', 25, ['autre25']],
                         ['37subvention_2011', 25, ['autre25']],   
                        ];
		for (var i = 0; i < tab_chkbx.length; i++) {
            if($("input[name='checkbox"+ tab_chkbx[i][0] +"["+ tab_chkbx[i][1] +"]']").is(':checked')) {
                for (var j = 0; j < tab_chkbx[i][2].length; j++) {	
                    $("input[name='checkbox"+ tab_chkbx[i][0] +"["+ tab_chkbx[i][2][j] +"]']").parent().show();
                }
            }
		}
        
        //Affichage des divs (boutons radio)
        //array = [id de la liste, nom de la liste sans l'année, texte input, div englobant suivant l'ensemble(optionnel - cas des autres types à ajouter))
        var tab_radio = [                         
                         [110, "bf_ta_exposition_concues", "ta_exposition_temporaire"],
                         [110, "bf_ta_exposition_concues", "radio110"],
                         [111, "bf_ta_exposition_interne", "ta_exposition_temporaire"],
                         [111, "bf_ta_exposition_interne", "radio111"],
                         [112, "bf_ta_exposition_partenariat", "ta_exposition_temporaire"],
                         [112, "bf_ta_exposition_partenariat", "radio112"],
                         [113, "bf_ta_exposition_recues", "ta_exposition_temporaire"],
                         [113, "bf_ta_exposition_recues", "radio113"],
                         [114, "bf_ta_exposition_ateliers", "radio114"],
                         [115, "bf_ta_action_conferences", "radio115"],
                         [116, "bf_ta_action_visites_guidees", "radio116"],
                         [117, "bf_ta_action_actions_itinerantes", "radio117"],
                         [118, "bf_ta_action_evenementiel", "radio118"],
                         [119, "bf_ta_action_formation", "radio119"],
                         [120, "bf_ta_action_ecole_nature", "radio120"],
                         [121, "bf_ta_action_autre", "radio121bf_ta_action_autre"],
                         [166, "bf_ta_operations_preparations", "radio166"],
                         [167, "bf_ta_operations_restaurations", "radio167"],
                         [185, "bf_ta_ressources", "radio185"],
                         [122, "bf_ta_recherche_travaux", "radio122"],
                         [123, "bf_ta_recherche_terrain", "radio123"],
                         [124, "bf_ta_recherche_publications", "radio124"],
                         [121, "bf_ta_recherche_autre", "radio121bf_ta_recherche_autre"],
                         [186, "bf_ta_expertise", "radio186"],
                         [187, "bf_ta_conseil", "radio187"],
                         [188, "bf_ta_formation", "radio188"],
                         [125, "bf_ta_production_papier", "radio125"],
                         [126, "bf_ta_production_multimedia", "radio126"],
                         [197, "bf_ta_autre_type1", "radio197_autre_type1", "autre_type2"],
                         [197, "bf_ta_autre_type2", "radio197_autre_type2", "autre_type3"],
                         [197, "bf_ta_autre_type3", "radio197_autre_type3", "autre_type4"],
                         [197, "bf_ta_autre_type4", "radio197_autre_type4"],                        
                         ],
        currentYear = (new Date).getFullYear();
        for (var year = 2010; year <= currentYear; year++) {                                               
            for (var i = 0; i < tab_radio.length; i++) {
                if($("input[name='radio"+ tab_radio[i][0] + tab_radio[i][1] + "_" + year + "1']").is(':checked')) {
                        $("#"+ tab_radio[i][2] + "_" + year).show();
                        $("#div_"+ tab_radio[i][3] + "_" + year).show(); //divs 'div_autre_type' à afficher
                        $("#ajout_"+ tab_radio[i][3] + "_" + year).hide();//liens a 'ajout_autre_type' à cacher
                }
            }
        }

		
		if($('input:regex(name,radio34bf_types_activites2)').is(':checked')) {
			$('input:regex(name,radio34bf_types_activites[3-9])').parent().parent().show();
		}

		if($('input:regex(name,^radio34bf_types_activites14)').is(':checked')) {
			$('input:regex(name,^radio34bf_types_activites1+[5-7])').parent().parent().show();
		}

		if($('input:regex(name,radio34bf_types_activites9)').is(':checked')) {
			$('input:regex(name,radio34bf_types_activites9autre)').parent().parent().show();
		}

		if($('input:regex(name,radio34bf_types_activites19)').is(':checked')) {
			$('input:regex(name,radio34bf_types_activites19autre)').parent().parent().show();
		}

});

$(document).ready(function () {

	// Gestion des expressions régulières
	jQuery.expr[':'].regex = function(elem, index, match) {
	   var matchParams = match[3].split(','),
		   validLabels = /^(data|css):/,
		   attr = {
			   method: matchParams[0].match(validLabels) ?
						   matchParams[0].split(':')[0] : 'attr',
			   property: matchParams.shift().replace(validLabels,'')
		   },
		   regexFlags = 'ig',
		   regex = new RegExp(matchParams.join('').replace(/^\s+|\s+$/g,''), regexFlags);
	   return regex.test(jQuery(elem)[attr.method](attr.property));
	}
    
    
    /********************/
	/*** AUTOCOMPLETE ***/
    /********************/
        
    $("#bf_ville_etablissement").autocomplete({
        source: 'ville_autocomplete.php',
        minLength: 4,
        select: function(event, ui) {
                    $('#bf_ville_etablissement').val(ui.item.value);
                    $('#bf_cp_etablissement').val(ui.item.cp);
                }
    });
        
    
    
    /*******************************/
	/*** DÉBUT PRE-QUESTIONNAIRE ***/
    /*******************************/
    
    
    //Adresse de redirection après le pré-questionnaire
    var url = "wakka.php?wiki=";
    var page = "MuseumS";
    
    // Affichage conditionnel musée mixte
	//liste avancement de l'informatisation
	$("#liste100bf_part_collections").change( function() {
		if ($(this).val()==2) {
            $("#musee_mixte").show();
            //page = "MuseesMixtes";
        }
        else {
            $("#musee_mixte").hide();
            //$("#liste26bf_musee_mixte").find("option").eq(0).attr('selected', 'selected');
            //page = "MuseumS";

        }
	});
    //pour la consultation on affiche
	$(".BAZ_cadre_fiche #musee_mixte").show();

	//a l'ouverture du formulaire, on affiche les sous listes en fonction du choix
	$("#formulaire #liste100bf_part_collections").each(function() {
		if ($(this).val()==2) {
            $("#musee_mixte").show();
        } else { 
            $("#musee_mixte").hide();
        }
	});
  
    /*
    //Ouverture d'un nouveau questionnaire et validation du pré-questionnaire
    //$("#formulaire").submit( function(event) {
    $("fieldset[id='prequestionnaire']").closest("form[id='formulaire']").submit( function() {
        alert("Apr\350s la validation de ce pr\351-questionnaire une nouvelle page va s'ouvrir avec votre questionnaire \" "+ page +"\"\n");
        window.open(url + page, 'museums');
        $(this).unbind('submit').submit();
        return false;
    });
    */ 
    
    /*****************************/
	/*** FIN PRE-QUESTIONNAIRE ***/
    /*****************************/
     //Boutons d'ajout des 4 autres types (boutons radio)
    for (var j = 2010; j<2012; j++) {
        for (var i = 1; i<5; i++) {
            $("a[id='ajout_autre_type"+i+"_"+j+"']").click( function(i,j) {
                    return function() {
                        //e.preventDefault();
                        $(this).data("idx",i);
                        $(this).data("jdx",j);
                        $("#div_autre_type" + $(this).data("idx") + "_"+ $(this).data("jdx")).show();
                        $(this).hide();
                        return false; // empêche le comportement par défaut
                    }            
            }(i,j));
        }
    }
    
    $("#liste26bf_responsable_competences").change( function() {
        if ($(this).val()==1) { $("#bf_responsable_competence").show(); } else { $("#bf_responsable_competence").hide(); }
    });
         
	
	//suppression des fieldsets pour les checkboxs
	$('input:regex(name,^checkbox4[3-9]),input:regex(name,^checkbox[5-9][0-9]),input:regex(name,^checkbox10[1-7]),input:regex(name,^checkbox12[8-9]),input:regex(name,^checkbox1[3-6][0-9])').parent().prev("legend").remove();
	$('input:regex(name,^checkbox4[3-9]),input:regex(name,^checkbox[5-9][0-9]),input:regex(name,^checkbox10[1-7]),input:regex(name,^checkbox12[8-9]),input:regex(name,^checkbox1[3-6][0-9])').parent().unwrap();
    $('input:regex(name,^checkbox174)').parent().prev("legend").remove();
	$('input:regex(name,^checkbox174)').parent().unwrap();

	// calcul de sommes automatique				  	
	$("input[name='bf_rh_fonctionnaires'],input[name='bf_rh_contractuels'],input[name='bf_rh_benevoles'],input[name='bf_rh_stagiaires'],input[name='bf_rh_statut_autre_']").sum("keyup", "#bf_rh_total_statut");
	$("input[name='bf_rh_direction'],input[name='bf_rh_administration'],input[name='bf_rh_conservation'],input[name='bf_rh_technique'],input[name='bf_rh_mediation'],input[name='bf_rh_communication'],input[name='bf_rh_expo'],input[name='bf_rh_documentation']").sum("keyup", "#bf_rh_total_secteur");
	
	//verifications au clic du bouton valider -- Vérification de la somme des ETPA / somme totale
	$("input[name='valider']").click( function() {
		if($("input[name='bf_rh_total']").val()){
			var i = $("input[name='bf_rh_total']").val();
			var j = $("input[name='bf_rh_total_statut']").val();
			var k = $("input[name='bf_rh_total_secteur']").val();
			if((i != j) || (i != k) || (j != k)){
				alert("La somme des ETPA saisis par statut("+ j +") et/ou par secteur("+ k +") est diff\351rente du total indiqu\351 : " + i);
			}
		}
	});
	
	//réécriture du titre des boutons radio
	//$("div.formulaire_ligne > div.formulaire_input:contains('principale/secondaire')").text("principale secondaire").css({"margin-left":"255px"}).prev().text("");
	
	// ligne de texte en italique
	$("input[id='bf_surface_expo_hn'],input[id='bf_expositions_concues'],input[id='bf_expositions_recues']").parent().parent().css("font-style","italic");

	// ligne de texte en gras
    $('#liste100bf_part_collections').parent().parent().find('div.formulaire_label').css("font-weight","bold");
	//$("input[id='bf_surface_totale'],input[id='bf_budget_total'],input[id='bf_rh_total']").parent().parent().css("font-weight","bold");
    var tab_bold = ['bf_rh_fonctionnaires_',
                    'bf_rh_contractuels_',
                    'bf_rh_benevoles_',
                    'bf_rh_stagiaires_',
                    'bf_rh_statut_autre_',
                   ];
    for (var i = 0; i<tab_bold.length; i++) {
        $('input:regex(id,^'+tab_bold[i]+')').parent().parent().css("font-weight","bold");
    }
	// ligne de texte en italique + retrait (budget)
	//$("h5[class='titre_intermediaire_budget']").css({"font-style":"italic","margin-left":"30px"});

	//Ajout d'une classe pour les labels des input text de Types d'activités
    $("fieldset[class='bazar_fieldset fieldset_types_activites'] input[type='radio']").parents('div.formulaire_ligne').children('div.formulaire_label').addClass('label_radio');
    
    
    // retrait + reduction taille champ input (frequentation)
	$('input:regex(id,^bf_frequentation_scolaires_20),input:regex(id,^bf_rh_cd),input:regex(id,^bf_budget_depenses_salaires_occ),input:regex(id,^bf_budget_depenses_investissement_a),input:regex(id,^bf_budget_depenses_investissement_m)').css({"width":"200px"});
	$('input:regex(id,^bf_frequentation_scolaires_20),input:regex(id,^bf_rh_cd),input:regex(id,^bf_budget_depenses_salaires_occ),input:regex(id,^bf_budget_depenses_investissement_a),input:regex(id,^bf_budget_depenses_investissement_m)').parent().parent().css({"margin-left":"100px","font-style":"italic"});
	$('input:regex(id,^bf_frequentation_groupes_20)').css({"width":"200px"});
	$('input:regex(id,^bf_frequentation_groupes_20)').parent().parent().css({"margin-left":"100px"});
	$('input:regex(id,^bf_rh_mis),input:regex(id,^bf_rh_vac),input:regex(id,^bf_rh_emp),input:regex(id,^bf_rh_fonction_publique_)').css({"width":"200px"});
	$('input:regex(id,^bf_rh_mis),input:regex(id,^bf_rh_vac),input:regex(id,^bf_rh_emp),input:regex(id,^bf_rh_fonction_publique_)').parent().parent().css({"margin-left":"100px","font-style":"italic"});
	$('input:regex(id,bf_surface_expo_hn)').css({"width":"200px"});
	$('input:regex(id,bf_surface_expo_hn)').parent().parent().css({"margin-left":"100px"});

	// ajout bulle d'aide
    $("input[name='checkbox85ethno-anthropo[1]']").next().after('&nbsp;<img class="tooltip_aide" title="Vos collections d\'anthropologie physique peuvent &ecirc;tre rang&eacute;es selon les cas dans l\'Ethnologie et/ou dans la Zoologie. Elles seront prises en compte via ces deux possibilit&eacute;s." src="tools/bazar/presentation/images/aide.png" width="16" height="16" alt="image aide">');
    $("input[name='checkbox106scientifiques[1]']").next().after('&nbsp;<img class="tooltip_aide" title="Cette cat&eacute;gorie regroupe des instruments, livres et autres objets qui contribuent &agrave; appr&eacute;hender l\'&eacute;volution de la recherche scientifique, et faisant l\'objet d\'une collection sp&eacute;cifique." src="tools/bazar/presentation/images/aide.png" width="16" height="16" alt="image aide">');
    $("input[name='checkbox90scientifiques[1]']").next().after('&nbsp;<img class="tooltip_aide" title="Lorsque ceux-ci font l\'objet d\'une collection sp&eacute;cifique, quelles que soient leurs disciplines d\'appartenance." src="tools/bazar/presentation/images/aide.png" width="16" height="16" alt="image aide">');
	$("input[name='checkbox92culturelles[1]']").next().after('&nbsp;<img class="tooltip_aide" title="Beaux-arts, arts d&eacute;coratifs, art contemporain, etc." src="tools/bazar/presentation/images/aide.png" width="16" height="16" alt="image aide">');
    $("input[name='checkbox63mammalogie[1]']").next().after('&nbsp;<img class="tooltip_aide" title="Vos collections d\'anthropologie physique peuvent &ecirc;tre rang&eacute;es selon les cas dans l\'Ethnologie et/ou dans la Zoologie. Elles seront prises en compte via ces deux possibilit&eacute;s." src="tools/bazar/presentation/images/aide.png" width="16" height="16" alt="image aide">');

    //ajout des optgroup
    var tab_optgroups_ids = [
                                [1, 'liste180bf_collection_interessante_scientifique1'],
                                [2, 'liste180bf_collection_interessante_scientifique2'],
                                [3, 'liste180bf_collection_interessante_pedagogique1'],
                                [4, 'liste180bf_collection_interessante_pedagogique2'],
                            ];
    var tab_optgroups_options = [                     
                                    [[1,2,3,4], 1, 'Botanique-Mycologie'],
                                    [[1,2,3,4], 3, 'G&eacute;ologie'],
                                    [[1,2,3,4], 5, 'Pal&eacute;ontologie'],
                                    [[1,2,3,4], 9, 'Zoologie'],
                                    [[1,2,3,4], 11, 'Arch&eacute;ologie'],
                                    [[1,2,3,4], 15, 'Ethno-Anthropologie'],                                    
                                ];                              
    for (var i = 0; i<tab_optgroups_ids.length; i++) {   
        for (var j = 0; j < tab_optgroups_options.length; j++) {
            if ($.inArray(tab_optgroups_ids[i][0], tab_optgroups_options[j][0]) > -1) {    
                $('#'+tab_optgroups_ids[i][1]+' option:eq('+tab_optgroups_options[j][1]+')').before('<optgroup label="'+tab_optgroups_options[j][2]+'">');
            }	
        }
    }                                         

    //boutons radios et div correspondantes
    var tab_types_activites = [
                                ['radio11[0-3]', 'ta_exposition_temporaire'],
                                ['radio110', 'radio110'],
                                ['radio111', 'radio111'],
                                ['radio112', 'radio112'],
                                ['radio113', 'radio113'],
                                ['radio114', 'radio114'],
                                ['radio115', 'radio115'],
                                ['radio116', 'radio116'],
                                ['radio117', 'radio117'],
                                ['radio118', 'radio118'],
                                ['radio119', 'radio119'],
                                ['radio120', 'radio120'],
                                ['radio121bf_ta_action_autre', 'radio121bf_ta_action_autre'],
                                ['radio122', 'radio122'],
                                ['radio123', 'radio123'],
                                ['radio124', 'radio124'],
                                ['radio121bf_ta_recherche_autre', 'radio121bf_ta_recherche_autre'],
                                ['radio125', 'radio125'],
                                ['radio126', 'radio126'],
                                ['radio166', 'radio166'],
                                ['radio167', 'radio167'],
                                ['radio185', 'radio185'],
                                ['radio186', 'radio186'],
                                ['radio187', 'radio187'],
                                ['radio188', 'radio188'], 
                                ['radio197bf_ta_autre_type1','radio197_autre_type1'],
                                ['radio197bf_ta_autre_type2','radio197_autre_type2'], 
                                ['radio197bf_ta_autre_type3','radio197_autre_type3'], 
                                ['radio197bf_ta_autre_type4','radio197_autre_type4'],     
                              ];
    
    //reset bouton radio - fonction globale
    //Reset des boutons radio au clic sur la partie label
    $("input[type='radio']").parent().prev().click( function(){
        $(this).next("div.formulaire_input").children().attr('checked', false);
    });
    // Affichage conditionnel boutons radio types d'activités
    for (var i = 0; i<tab_types_activites.length; i++) {
        var annee_fin = 2011;
        //Parcours du tableau en fonction des années
        for (var j = 2010; j <= annee_fin; j++) {
            var id = tab_types_activites[i][1]+"_"+j;
            $("input:regex(name,^"+tab_types_activites[i][0]+".*"+j+"1$)").click( function(id) {
                return function() {
                    $(this).data("idx",id);
                    $("#"+$(this).data("idx")).show();
                }
            }(id));
        }
    }
    

	// Affichage des checkbox les uns en dessous des autres + style="float:left; width: 400px"
	//$(".bazar_checkbox").after("<div style='height:15px;display:block;'></div>");
	$(".bazar_checkbox").css({"float":"left","width":"400px"});

	// Masquage des zones de texte pour les champs 'autre' des checkbox
	$('input:regex(id,autre$)').parent().hide();
	//$('input:regex(id,autre$)').parent().next().hide();
	
	
	//Ajout d'un retrait aux checkbox
	$('input:regex(name,^checkbox37subvention_2010\\[([2-9]|10|1+[2-4]||1+[6-9]||2+[1-2])\\])').parent().css("margin-left","15px");
	$('input:regex(name,^checkbox37subvention_2011\\[([2-9]|10|1+[2-4]||1+[6-9]||2+[1-2])\\])').parent().css("margin-left","15px");
    
	// Retrait et masquage par défaut
	$('input:regex(name,^checkbox24\\[([2-9]|10|12|17|2+[0-9]|3+[3-4])\\])').parent().css({"margin-left":"15px", "display": "block"}); // masquage de la div
  	$('input:regex(name,^checkbox24\\[(1+[3-6]|1+[8-9]|2+[0-1]|2+[4-7]|)\\])').parent().css({"margin-left":"30px", "display": "block"}); // masquage de la div
    
    //Ajout de la mention "direction de rattachement" dans la partie Etablissement/Statut administratif
    $('input:regex(name,^checkbox24\\[(13|18|24)\\])').before("Direction de rattachement<br />");
    
    
	//$('input:regex(name,^checkbox(24|31)\\[([2-9]|10|1+[2-5]|1+[7-8])\\])').parent().next().css("display", "inline"); //masquage des sauts de ligne
	$('input:regex(name,radio34bf_types_activites([3-9]|1+[5-7]))').parent().parent().css({"margin-left":"60px", "display": "none"});
	$('input:regex(name,radio34bf_types_activites(9|19)autre)').parent().parent().css("display","none");
	$('input:regex(name,^checkbox36\\[(2|3|5|6)\\])').parent().css({"margin-left":"15px", "display": "none"});
	//$('input:regex(name,^checkbox36\\[(2|3|5|6)\\])').parent().next().css("display", "none");

    /*
     *  Action : Affichage conditionnel dans les checkboxs - Effacement des champs quand les cases sont décochées
     *  Onglet : Collection
     *  Question : Catégories de collections
     * 
     */
    var tab_checkbox = [
                            [43, 'col_sc_nat'],
                            [54, 'col_sc_nat'],
                            [57, 'col_sc_nat'],
                            [60, 'col_sc_nat'],
                            [44, 'botanique-mycologie'],
                            [45, 'botanique'],
                            [47, 'botanique'],
                            [48, 'botanique'],
                            [49, 'botanique'],
                            [50, 'botanique'],
                            [53, 'botanique-mycologie'],
                            [101, 'mycologie'],
                            [48, 'mycologie'],
                            [49, 'mycologie'],
                            [50, 'mycologie'],
                            [58, 'zoologie'],
                            [59, 'zoologie'],
                            [61, 'vertebres'],
                            [68, 'vertebres'],
                            [69, 'vertebres'],
                            [70, 'vertebres'],
                            [71, 'invertebres'],
                            [74, 'invertebres'],
                            [76, 'invertebres'],
                            [55, 'geologie'],
                            [56, 'geologie'],
                            [58, 'paleontologie'],
                            [59, 'paleontologie'],
                            [44, 'paleontologie'],
                            [102, 'paleontologie'],
                            [62, 'mammalogie'],
                            [63, 'mammalogie'],
                            [64, 'mammalogie'],
                            [50, 'mammalogie'],
                            [62, 'ornithologie'],
                            [63, 'ornithologie'],
                            [64, 'ornithologie'],
                            [104, 'ornithologie'],
                            [105, 'ornithologie'],
                            [50, 'ornithologie'],
                            [62, 'herpethologie'],
                            [63, 'herpethologie'],
                            [64, 'herpethologie'],
                            [50, 'herpethologie'],
                            [62, 'ichtyologie'],
                            [63, 'ichtyologie'],
                            [64, 'ichtyologie'],
                            [50, 'ichtyologie'],
                            [72, 'entomologie'],
                            [64, 'entomologie'],
                            [50, 'entomologie'],
                            [75, 'malacologie'],
                            [64, 'malacologie'],
                            [50, 'malacologie'],
                            [77, 'autres_invertebres'],
                            [64, 'autres_invertebres'],
                            [50, 'autres_invertebres'],
                            [79, 'scientifiques'],
                            [80, 'scientifiques'],
                            [84, 'scientifiques'],
                            [88, 'scientifiques'],
                            [89, 'scientifiques'],
                            [106, 'scientifiques'],
                            [107, 'scientifiques'],
                            [90, 'scientifiques'],
                            [50, 'scientifiques'],
                            [92, 'culturelles'],
                            [93, 'culturelles'],
                            [50, 'culturelles'],
                            [78, 'autres_col'],
                            [91, 'autres_col'],
                            [81, 'archeo'],
                            [82, 'archeo'],
                            [83, 'archeo'],
                            [50, 'archeo'],
                            [85, 'ethno-anthropo'],
                            [86, 'ethno-anthropo'],
                            [87, 'ethno-anthropo'],
                            [44, 'types_disciplines'],
                            [60, 'types_disciplines'],
                            [54, 'types_disciplines'],
                            [57, 'types_disciplines'],
                            [58, 'types_zoologie'],
                            [59, 'types_zoologie'],
                            [61, 'types_vertebres'],
                            [68, 'types_vertebres'],
                            [69, 'types_vertebres'],
                            [70, 'types_vertebres'],
                            //[50, 'types_vertebres'],
                            [71, 'types_invertebres'],
                            [74, 'types_invertebres'],
                            [50, 'types_invertebres'],
                            [58, 'types_paleo'],
                            [59, 'types_paleo'],
                            [44, 'types_paleo'],
                            [44, 'disparus_disciplines'],
                            [60, 'disparus_disciplines'],
                            [58, 'disparus_zoologie'],
                            [59, 'disparus_zoologie'],
                            [61, 'disparus_vertebres'],
                            [68, 'disparus_vertebres'],
                            [69, 'disparus_vertebres'],
                            [70, 'disparus_vertebres'],
                            //[50, 'disparus_vertebres'],
                            [71, 'disparus_invertebres'],
                            [74, 'disparus_invertebres'],
                            [50, 'disparus_invertebres'],
                            [44, 'figures_disciplines'],
                            [60, 'figures_disciplines'],
                            [54, 'figures_disciplines'],
                            [57, 'figures_disciplines'],
                            [58, 'figures_zoologie'],
                            [59, 'figures_zoologie'],
                            [61, 'figures_vertebres'],
                            [68, 'figures_vertebres'],
                            [69, 'figures_vertebres'],
                            [70, 'figures_vertebres'],
                            //[50, 'figures_vertebres'],
                            [71, 'figures_invertebres'],
                            [74, 'figures_invertebres'],
                            [50, 'figures_invertebres'],
                            [58, 'figures_paleo'],
                            [59, 'figures_paleo'],
                            [44, 'figures_paleo'],
                            [138, 'bf_types_espaces_espaces_exposition'],
                            [139, 'bf_types_espaces_permanents'],
                            [140, 'bf_types_espaces_consacres'],
                            [141, 'bf_types_espaces_temporaires'],
                            [143, 'bf_types_espaces_dedies_vivant'],
                            [144, 'bf_types_espaces_conservation'],
                            //[145, 'bf_types_espaces_conservation_total'],
                            [146, 'bf_types_espaces_conservation_scnat'],
                            [147, 'bf_types_espaces_conservation_insitu'],
                            [148, 'bf_types_espaces_conservation_exsitu'],
                            [149, 'bf_types_espaces_mediation'],
                            [150, 'bf_types_espaces_accueil'],
                            [151, 'bf_types_espaces_commerciaux'],
                            [152, 'bf_types_espaces_travail'],
                            [153, 'bf_types_espaces_agrement'],
                            [168, 'bf_types_espaces_techniques'],
                            [50, 'bf_types_espaces_autre'],
                            [154, 'bf_types_equipements_auditorium'],
                            [155,'bf_types_equipements_bibliotheque'],
                            [50, 'bf_types_equipements_autre'],                     
                        ],
        id = "";
    for (var i = 0; i<tab_checkbox.length; i++) {
        id = "checkbox" + tab_checkbox[i][0] + tab_checkbox[i][1];
        $("input[name='"+id+"[1]']").change( function(id) {
            return function() {
                $(this).data("idx",id);
                if($(this).is(':checked')) {
                    $("#"+$(this).data('idx')).show();
                } else {
                    $("#"+$(this).data('idx')+" :input").val("");//effacement des champs input text
                    $("#"+$(this).data('idx')+" input[type='checkbox']").attr('checked', false);//décochement des cases
                    $("#"+$(this).data('idx')).hide();
                }
            }
        }(id));
    }
   
    
    /*
     *  Action : Affichage conditionnel dans les checkboxs - Effacement des champs quand les cases sont décochées
     *  Onglet : Collection; etablissement
     *  Question : Types, figurés, disparus; Espaces et équipements spécifiques
     * 
     */
	var tab_ckbox = [ 
                       ['checkbox60types_disciplines[1]','types_zoologie'],
                       ['checkbox58types_zoologie[1]','types_zoologie_vertebres'],
                       ['checkbox59types_zoologie[1]','types_zoologie_invertebres'],
                       ['checkbox57types_disciplines[1]','types_paleo'],
                       ['checkbox60figures_disciplines[1]','figures_zoologie'],
                       ['checkbox58figures_zoologie[1]','figures_zoologie_vertebres'],
                       ['checkbox59figures_zoologie[1]','figures_zoologie_invertebres'],
                       ['checkbox57figures_disciplines[1]','figures_paleo'],
                       ['checkbox60disparus_disciplines[1]','disparus_zoologie'],
                       ['checkbox58disparus_zoologie[1]','disparus_zoologie_vertebres'],
                       ['checkbox59disparus_zoologie[1]','disparus_zoologie_invertebres'],
                       ['checkbox44bf_types_consultations_botanique_2010[1]', 'div_types_consultations_botanique_2010'],
                       ['checkbox60bf_types_consultations_zoologie_2010[1]', 'div_types_consultations_zoologie_2010'],
                       ['checkbox54bf_types_consultations_geologie_2010[1]', 'div_types_consultations_geologie_2010'],
                       ['checkbox57bf_types_consultations_paleontologie_2010[1]', 'div_types_consultations_paleontologie_2010'],
                       ['checkbox44bf_types_consultations_botanique_2011[1]', 'div_types_consultations_botanique_2011'],
                       ['checkbox60bf_types_consultations_zoologie_2011[1]', 'div_types_consultations_zoologie_2011'],
                       ['checkbox54bf_types_consultations_geologie_2011[1]', 'div_types_consultations_geologie_2011'],
                       ['checkbox57bf_types_consultations_paleontologie_2011[1]', 'div_types_consultations_paleontologie_2011'],
                       ['checkbox138bf_types_espaces_espaces_exposition[1]','div_espaces_exposition'],
                       ['checkbox143bf_types_espaces_dedies_vivant[1]','div_espaces_dedies_vivant'],
                       ['checkbox144bf_types_espaces_conservation[1]','div_espaces_conservation'],
                       ['checkbox161bf_provenance_region[1]', 'div_bf_provenance_region'],
                       ['checkbox162bf_provenance_france[1]', 'div_bf_provenance_france'],
                       ['checkbox163bf_provenance_europe[1]', 'div_bf_provenance_europe'],
                       ['checkbox164bf_provenance_monde[1]', 'div_bf_provenance_monde'],
                       ['checkbox171bf_web_publications[2]', 'div_newsletter'],
                       ['checkbox173bf_web_site[2]','div_web_site'],
                       ['checkbox173bf_web_site[3]','div_web_site'],
                       ['checkbox176bf_label_tourisme_handicap_choix[1]','checkbox176bf_label_tourisme_handicap_choix1'],
                       ['checkbox176bf_label_tourisme_handicap_choix[2]','checkbox176bf_label_tourisme_handicap_choix2'],
                       ['checkbox176bf_label_tourisme_handicap_choix[3]','checkbox176bf_label_tourisme_handicap_choix3'],
                       ['checkbox176bf_label_tourisme_handicap_choix[4]','checkbox176bf_label_tourisme_handicap_choix4'],
                    ],
        id ='';             
	for (var i = 0; i<tab_ckbox.length; i++) {
        id = tab_ckbox[i][1];
        $("input[name='"+tab_ckbox[i][0]+"']").change( function(id) {
            return function() {
                $(this).data("idx",id);
                if($(this).is(':checked')) {
                    $("#"+$(this).data("idx")).show();
                } else {
                    $("#"+$(this).data("idx")+" input[type='text']").val("");//effacement des champs input text
                    $("#"+$(this).data("idx")+" input[type='checkbox']").attr('checked', false);//décochement des cases
                    $("#"+$(this).data("idx")).hide();
                }
            }    
        }(id));
    }
    
    /*
     *  Action : Affichage conditionnel dans les checkboxs - Affichage des classes correspondantes
     *  Onglet : Collection
     *  Question : inventaire informatisé et récolement
     * 
     */
	var tab_ckbox = [
                       ['checkbox43col_sc_nat[1]','classe_avancement_fiches_saisies_botamyco'],
                       ['checkbox54col_sc_nat[1]','classe_avancement_fiches_saisies_geologie'],
                       ['checkbox57col_sc_nat[1]','classe_avancement_fiches_saisies_paleo'],
                       ['checkbox58zoologie[1]','classe_avancement_fiches_saisies_zoovertebres'],
                       ['checkbox59zoologie[1]','classe_avancement_fiches_saisies_zooinvertebres'],
                       ['checkbox80scientifiques[1]','classe_avancement_fiches_saisies_archeo'],
                       ['checkbox84scientifiques[1]','classe_avancement_fiches_saisies_ethno'],
                    ],
        id ='';             
	for (var i = 0; i<tab_ckbox.length; i++) {
        id = tab_ckbox[i][1];
        $("input[name='"+tab_ckbox[i][0]+"']").change( function(id) {
            return function() {
                $(this).data("idx",id);
                if($(this).is(':checked')) {
                    $("."+$(this).data("idx")).show();
                } else {
                    $("."+$(this).data("idx")).hide();
                    $("."+$(this).data("idx")+" :input").val("");
                }
            }    
        }(id));
    }
	
    //Affichage des cases 'autre'    
    $('input:regex(name,^checkbox50)').change( function() {
        var champ_input = $(this).parent().next("div[class='bazar_checkbox']");
        if($(this).is(':checked')) { 
            champ_input.show();
        } else {
            champ_input.hide();
            champ_input.children(":input").val("");
        }
    });
    //Ajout de classe pour changer la taille du champ - voir css
    $('input:regex(name,^checkbox50)').addClass('input_autre');
    
    //Affichage des cases 'autre', autres que checkbox50
    var tab_cbox = [
                    ['checkbox170bf_web_reseaux_sociaux[5]','checkbox170bf_web_reseaux_sociaux5autre'],
                    ['checkbox36[8]','checkbox368autre'],
                    ['checkbox37subvention_2010[14]','checkbox37subvention_201014autre'],
                    ['checkbox37subvention_2010[25]','checkbox37subvention_201025autre'],
                    ['checkbox37subvention_2011[14]','checkbox37subvention_201114autre'],
                    ['checkbox37subvention_2011[25]','checkbox37subvention_201125autre'],
                    ['checkbox171bf_web_publications[3]','checkbox171bf_web_publications3autre'],
                    ['checkbox24[16]','checkbox2416autre'],
                    ['checkbox24[21]','checkbox2421autre'],
                    ['checkbox24[27]','checkbox2427autre'],
                    ['checkbox24[37]','checkbox2437autre'],
                    ['checkbox181bf_offres_tarifaires_2010[3]','checkbox181bf_offres_tarifaires_20103autre'],
                    ['checkbox181bf_offres_tarifaires_2011[3]','checkbox181bf_offres_tarifaires_20113autre'],
                   ],
        id = '';
    for (var i = 0; i<tab_cbox.length; i++) {
        id = tab_cbox[i][1];               
        $("input[name='"+tab_cbox[i][0]+"']").change( function(id) {
            return function() {
                $(this).data("idx",id);
                if($(this).is(':checked')) {
                    $("#"+$(this).data("idx")).parent().show();
                } else {
                    $("#"+$(this).data("idx")).parent().hide();
                    $("#"+$(this).data("idx")).val("");
                }
            }
        }(id));
	}
    //Dans les checkboxs :  si une case est cochée les autres sont grisées
    var tab_index = [
                        ['checkbox170bf_web_reseaux_sociaux', 1, [2,3,4,5]],
                        ['checkbox171bf_web_publications', 1, [2,3]],
                        ['checkbox173bf_web_site', 1, [2,3]],
                    ],
        bfname       = '',
        _1erecase    = '',
        _autrescases = '';
    for (var i = 0; i<tab_index.length; i++) {
        bfname       = tab_index[i][0];
        _1erecase    = tab_index[i][1];
        _autrescases = tab_index[i][2];                   
        $("input[name='"+bfname+"["+_1erecase+"]']").click( function(bfname, _1erecase, _autrescases) {
            return function() {
                $(this).data("databfname",bfname);
                $(this).data("data_1erecase",_1erecase);
                $(this).data("data__autrescases",_autrescases);
                if($(this).is(':checked')) {
                    for (var i= 0; i< $(this).data("data__autrescases").length; i++) {
                       $("input[name='"+bfname+"["+$(this).data("data__autrescases")[i]+"]']").attr("disabled","true");
                       $("input[name='"+bfname+"["+$(this).data("data__autrescases")[i]+"]']").removeAttr("checked");
                    }
                } else {
                    $('input:regex(name,^'+$(this).data("databfname")+')').removeAttr("disabled");
                }
            }
        }(bfname, _1erecase, _autrescases));
    }
    
    //Mode de comptage
	//Affichage conditionnel dans les checkboxs (niveau 1 -> niveau 2 ->...)
	$('input:regex(name,^checkbox36\\[1\\])').change(function() {
		if($(this).is(':checked')) {
			$('input:regex(name,^checkbox36\\[[1-2]\\])').parent().next().show();
			//$('input:regex(name,^checkbox36\\[[1-2]\\])').parent().next().next().show();
		} else {
			$('input:regex(name,^checkbox36\\[[1-2]\\])').parent().next().hide();
			//$('input:regex(name,^checkbox36\\[[1-2]\\])').parent().next().next().hide();
		}
	});
	//Affichage conditionnel dans les checkboxs (niveau 1 -> niveau 2 ->...)
	$('input:regex(name,^checkbox36\\[4\\])').change(function() {
		if($(this).is(':checked')) {
			$('input:regex(name,^checkbox36\\[[4-5]\\])').parent().next().show();
			//$('input:regex(name,^checkbox36\\[[4-5]\\])').parent().next().next().show();
		} else {
			$('input:regex(name,^checkbox36\\[[4-5]\\])').parent().next().hide();
			//$('input:regex(name,^checkbox36\\[[4-5]\\])').parent().next().next().hide();
		}
	});
	
	
	
    
    //Divs à déplier et replier
    var tab_div2fold = [
                            ['adresse_site1', 'adresse_etablissement_site1'],
                            ['adresse_site2', 'adresse_etablissement_site2'],
                            ['adresse_site3', 'adresse_etablissement_site3'],
                            ['adresse_site4', 'adresse_etablissement_site4'],
                            ['inv_rec_2010', 'inventaire_recolement_2010'],
                            ['inv_rec_2011', 'inventaire_recolement_2011'],
                            ['h3_typ_act_2010', 'div_typ_act_2010'],
                            ['h3_typ_act_2011', 'div_typ_act_2011'],
                            ['h4_frequentation_2008', 'div_frequentation_2008'],
                            ['h4_frequentation_2009', 'div_frequentation_2009'],
                            ['h4_frequentation_2010', 'div_frequentation_2010'],
                            ['h4_frequentation_2011', 'div_frequentation_2011'],
                            ['h4_consultations_scientifiques_2010', 'div_consultations_scientifiques_2010'],
                            ['h4_consultations_scientifiques_2011', 'div_consultations_scientifiques_2011'],
                            ['h4_ouverture_public_2010', 'div_ouverture_public_2010'],
                            ['h4_ouverture_public_2011', 'div_ouverture_public_2011'],
                            ['h4_renovation_2011', 'div_renovation_2011'],
                            ['h4_dyn_collections_2011', 'div_dyn_collections_2011'],
                            ['h4_tarification_2010', 'div_tarification_2010'],
                            ['h4_tarification_2011', 'div_tarification_2011'],
                            ['h4_budget_2010', 'div_budget_2010'],
                            ['h4_budget_2011', 'div_budget_2011'],
                            ['h4_rh_2010', 'div_rh_2010'],
                            ['h4_rh_2011', 'div_rh_2011'],
                            ['reseau1', 'div_reseau1'],
                            ['reseau2', 'div_reseau2'],
                            ['reseau3', 'div_reseau3'],
                            ['reseau4', 'div_reseau4'],
                            ['reseau5', 'div_reseau5'],
                            ['reseau6', 'div_reseau6'],
                            ['reseau7', 'div_reseau7'],
                            ['reseau8', 'div_reseau8'],
                            ['reseau9', 'div_reseau9'],
                            ['reseau10', 'div_reseau10'],
                       ];
    for (var i = 0; i<tab_div2fold.length; i++) {
        var id = tab_div2fold[i][1];                         
        $("#"+tab_div2fold[i][0]).click( function(id){
            return function() {
                $(this).data("idx",id);                
                if ($("#"+$(this).data("idx")).is(":visible")) {
                    $("#"+$(this).data("idx")).slideUp("slow");
                    $(this).removeClass();
                    $(this).addClass('deplier');
                } else {
                    $("#"+$(this).data("idx")).slideDown("slow");
                    $(this).removeClass();
                    $(this).addClass('plier');
                    $("#"+$(this).data("idx")+" div").each(
                        function(){
                            if ($(this).hasClass("show_when_unfold")){
                                $(this).show();
                            }
                        }
                    );
                }
            }
        }(id));
    }

    // div à afficher en fonction du choix dans la liste déroulante
    var tab_div2show = [
                            ['liste26inventaire_ouinon', 'ok_inventaire', [1]],
                            ['liste26inventaire2010', 'ok_inventaire2010', [1]],
                            ['liste26inventaire2011', 'ok_inventaire2011', [1]],
                            ['liste38', 'liste38nombre', [1,2,3]],
                            ['liste160bf_niveau_etude_chefetablissement', 'liste160choix8', [8]],
                            ['liste39bf_statut_contributeur', 'statut_contributeur', [4]],
                            ['liste39bf_statut_chefetablissement', 'statut_chefetablissement', [4]],
                            ['liste39bf_statut_responsable', 'statut_responsable', [4]],
                            ['liste40bf_grade_contributeur', 'grade_contributeur', [1,2,3]],
                            ['liste40bf_grade_responsable', 'grade_responsable', [1,2,3]],
                            ['liste40bf_grade_chefetablissement', 'grade_chefetablissement', [1,2,3]],
                            ['liste40bf_grade_contributeur', 'grade_contributeur_autre', [4]],
                            ['liste40bf_grade_responsable', 'grade_responsable_autre', [4]],
                            ['liste40bf_grade_chefetablissement', 'grade_chefetablissement_autre', [4]],
                            ['liste27bf_renovation_avant_2011', 'liste27bf_renovation_avant_2011choix2', [2]], //rénovation (onglet etablissement)
                            ['liste27bf_renovation_avant_2011', 'liste27bf_renovation_avant_2011choix3', [3]], //rénovation (onglet etablissement)
                            ['liste20avancement_informatisation', 'liste20informatisation', [1,2], 0], //informatisation de l'inventaire  (onglet collections)
                            ['liste20avancement_informatisation', 'liste20informatisationchoix1ou22010', [1,2], 'inv_rec_2010'], //informatisation de l'inventaire  (onglet collections)
                            ['liste20avancement_informatisation', 'liste20informatisationchoix1ou22011', [1,2], 0], //informatisation de l'inventaire  (onglet collections)
                            ['liste20avancement_informatisation', 'liste20informatisation_avancement_fiches_saisies2010', [1], 'inv_rec_2010'], //informatisation de l'inventaire  (onglet collections)
                            ['liste20avancement_informatisation', 'liste20informatisation_avancement_fiches_illustrees2010', [1], 'inv_rec_2010'], //informatisation de l'inventaire  (onglet collections)    
                            ['liste20avancement_informatisation', 'liste20informatisation_avancement_fiches_saisies2011', [1], 0], //informatisation de l'inventaire  (onglet collections)
                            ['liste20avancement_informatisation', 'liste20informatisation_avancement_fiches_illustrees2011', [1], 0], //informatisation de l'inventaire  (onglet collections)
                            ['liste20avancement_recolement', 'liste20recolement2010', [1], 'inv_rec_2010'], //avancement du recolement (onglet collections)
                            ['liste20avancement_recolement', 'liste20recolement2011', [1], 0], //avancement du recolement (onglet collections)
                            ['liste136bf_psc_termine', 'liste136choix2', [2]], //PSC terminé ou en cours (onglet etablissement)
                            ['liste25bf_ouverture_public_2010', 'liste25choix1_2010', [1]], //Ouverture au public (onglet etablissement)
                            ['liste25bf_ouverture_public_2010', 'liste25choix2_2010', [2]], //Ouverture au public (onglet etablissement)
                            ['liste25bf_ouverture_public_2011', 'liste25choix1_2011', [1]], //Ouverture au public (onglet etablissement)
                            ['liste25bf_ouverture_public_2011', 'liste25choix2_2011', [2]], //Ouverture au public (onglet etablissement)
                            ['liste27bf_musee_renovation_2011', 'liste27bf_musee_renovation_2011choix2ou3_2011', [2,3]], //Rénovation (onglet etablissement)
                            ['liste175bf_acces_handicap', 'liste175quelhandicap', [2,3]], //accès handicapé
                            ['liste26bf_label_tourisme_handicap', 'liste175labelquelhandicap', [1]],
                            ['liste26bf_responsable_competences', 'bf_responsable_competences', [1]],
                            ['liste27bf_tarification_gratuite_musee_2010','div_gratuite_beneficiaires_2010',[2,3]],
                            ['liste27bf_tarification_gratuite_musee_2011','div_gratuite_beneficiaires_2011',[2,3]],
                        ];
    for (var i = 0; i<tab_div2show.length; i++) {   
        var idselect  = tab_div2show[i][0],//id du bouton select sur lequel se déclenche l'action
            iddiv     = tab_div2show[i][1],//id de la div à afficher
            idoptions = tab_div2show[i][2],//numéros des options du select qui déclenchent l'action
            stayhidden = tab_div2show[i][3];//titre h4 ou h3 des années repliées par défaut - 0 si l'année est dépliée par défaut (en général la dernière année)
                            
        // Affichage conditionnel statut du contributeur
        $("select[id='"+idselect+"']").change( function(iddiv, idoptions, stayhidden) {
            return function() {
                $(this).data("idxdiv",iddiv);
                $(this).data("idxoptions",idoptions);
                $(this).data("stayxhidden", stayhidden);
                if ($.inArray(parseInt($(this).val()), $(this).data("idxoptions")) > -1) {
                    $("#"+$(this).data("idxdiv")).show();
                    if ( typeof $(this).data("stayxhidden") !== "undefined" && $(this).data("stayxhidden") !== 0 ) {
                        if ($("#"+$(this).data("stayxhidden")).hasClass('deplier')) { $("#"+$(this).data("idxdiv")).hide(); }
                        $("#"+$(this).data("idxdiv")).addClass("show_when_unfold");
                        }
                }    
                else { 
                    $("#"+$(this).data("idxdiv")).hide();
                    if ($("#"+$(this).data("idxdiv")).hasClass("show_when_unfold")) {$("#"+$(this).data("idxdiv")).removeClass("show_when_unfold");}
                    $("#"+$(this).data("idxdiv")+" :input").val("");//effacement des champs input,textarea,button et select
                }
            }
        }(iddiv, idoptions, stayhidden));
       
        //pour la consultation on affiche
        $(".BAZ_cadre_fiche #"+iddiv).show();
        //a l'ouverture du formulaire, on affiche les sous listes en fonction du choix
        $("#formulaire select[id='"+idselect+"']").each(function(iddiv, idoptions) {
            return function() {
                $(this).data("idxdiv",iddiv);
                $(this).data("idxoptions",idoptions);
                if (($.inArray(parseInt($(this).val()), tab_div2show[i][2])) > -1) {
                    $("#"+$(this).data("idxdiv")).show();
                }
                else { 
                    $("#"+$(this).data("idxdiv")).hide();
                    $("#"+$(this).data("idxdiv")+" :input").val("");//effacement des champs input,textarea,button et select
                }
            }    
        }(iddiv, idoptions));
    }
    
    
    
    /*
     *  Action : Ajout d'informations dans labels checkboxs
     *  Onglet : Etablissement
     *  Question : Espaces et equipement spécifiques
     * 
     */
    var tab_ajoutinfo = [
                            ['checkbox144bf_types_espaces_conservation[1]', ' <i>(r&eacute;serves)</i>'],
                            ['checkbox150bf_types_espaces_accueil[1]', ' <i>(halls, sanitaires, vestiaires, etc.)</i>'],
                            ['checkbox151bf_types_espaces_commerciaux[1]', ' <i>(boutiques, caf&eacute;t&eacute;ria)</i>'],
                            ['checkbox152bf_types_espaces_travail[1]', ' <i>(locaux personnel : administratif, &eacute;tude)</i>'],
                            ['checkbox168bf_types_espaces_techniques[1]', ' <i>(menuiserie, restauration, etc.)</i>'],
                            ['checkbox153bf_types_espaces_agrement[1]', ' <i>(jardins-parc)</i>'],
                        ];
    for (var i = 0; i<tab_ajoutinfo.length; i++) {                        
        $("input[name='"+tab_ajoutinfo[i][0]+"']").next('label').append(tab_ajoutinfo[i][1]);
    }

	// Mentions des champs numériques sur la premiere page de saisie
	$('div.symbole_obligatoire').after('<div><img src="tools/templates/themes/sobre/images/losange.gif" alt="**"/> champs num&eacute;riques (utilisez le point . comme s&eacute;parateur num&eacute;rique)</div>');

	//1ère lettre en majuscule dans les champs input suivants :
	$("input[name^='bf_fonction'],input[name^='bf_collection_importante'],textarea[name='bf_autre_type_collection']").blur(function() {
	   this.value = this.value.charAt(0).toUpperCase() + this.value.substring(1);
	}); 
	 
	// Champs en majuscules
	$("input[name^='bf_ville'], input:regex(id,^bf_titre), input:regex(id,^bf_nom)").blur(function(){ this.value = this.value.toUpperCase(); });
	
});
