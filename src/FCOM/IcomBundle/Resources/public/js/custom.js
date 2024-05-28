jQuery(document).ready(function() {

	jQuery('#main-menu ul.menu').mobileMenu();



	/*VIEW TODOS LOS TRABAJOS****************************************************/
	jQuery('#block-system-main .show_hidden_resumen').click(function () {
		jQuery(this).siblings().fadeToggle('fast');
		jQuery(this).hide();
	});


	jQuery('#block-system-main .hidden_hidden_resumen').click(function () {
		jQuery(this).siblings().fadeToggle('fast');
		jQuery(this).hide();
	});

	jQuery('#block-system-main .more_fields_todos_los_trabajos').click(function () {
		jQuery("td.views-field-field-documento-general, td.views-field-mail,td.views-field-field-pais,th.views-field-field-documento-general,th.views-field-mail,th.views-field-field-pais").fadeIn();
		jQuery(this).hide();
		jQuery('#block-system-main .less_fields_todos_los_trabajos').show();
	});
	jQuery('#block-system-main .less_fields_todos_los_trabajos').click(function () {
		jQuery("td.views-field-field-documento-general, td.views-field-mail,td.views-field-field-pais,th.views-field-field-documento-general,th.views-field-mail,th.views-field-field-pais").fadeOut('fast');
		jQuery(this).hide();
		jQuery('#block-system-main .more_fields_todos_los_trabajos').show();
	});
	/*********************************************************************************/

	/*ADD Ponencia********************************************************************/


	jQuery('#edit-field-autor-und-form legend span').html('Añadir autor');
	jQuery('#edit-field-autor-und-form-actions-ief-add-save').val('Añadir autor');
	jQuery('#edit-field-autor-und-entities-0-form-actions-ief-edit-save').val('Actualizar');




	/*********************************************************************************/


/* Navigation */
	jQuery('#main-menu ul.menu').superfish({ 
		delay:       500,								// 0.1 second delay on mouseout 
		animation:   {opacity:'show',height:'show'},	// fade-in and slide-down animation 
		dropShadows: true								// disable drop shadows 
	});	

});