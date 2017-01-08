
jQuery(document).ready(function ($)
{
    var $ar_settings = $('#ar-settings');
    var $hidden_fields_container = $('.wi-form-fields--hidden .fieldblock__content');
    var $wi_available_fields = $('#wi-available-fields');
    var $ar_code = $('#ar_code');
    var $form_builder = $('#wi-form-builder');
    var $ar_available_mappings = $('#ar_available_mappings');
    var $extracted_form_fields = $('.extracted-form_fields');

    wait
    ({
      on:'wi-form-builder',
      do:function()
      {
          $ar_code.change(function ()
          {
              var $fields = get_form_fields($(this));
              $wi_available_fields.html('');
              $hidden_fields_container.html('');
              $ar_available_mappings.removeData('mappings');
              $fields.each(function () {
                  if ($.inArray($(this).attr('type'), ['text', 'email']) >= 0 || $.inArray($(this).context.tagName, ['textarea', 'select']) >= 0) {
                      if (!$ar_available_mappings.data('mappings')) {
                          var mappings = [];

                      } else {
                          var mappings = $ar_available_mappings.data('mappings');
                      }
                      mappings.push($(this).attr('name'));
                      $ar_available_mappings.data('mappings', mappings);
                  } else {
                      //store hidden fields to add them later
                      ar_add_form_field_hidden($(this).attr('name'), $(this).val());
                  }
              });
              //hide fields that are used already
              hide_used_fields();
          });

          // when page is loaded, populate the form builder area
          $ar_code.change();
          // up to here

          function hide_used_fields() {
              $extracted_form_fields.find('.wi-form-field').each(function () {
                  if ($(this).children('.wi-field-add').length > 0) {
                      var field_name = $(this).children('.wi-field-add').data('name');
                      if (field_name) {
                          if (is_field_name_in_form_builder(field_name))
                              $(this).hide();
                          else
                              $(this).show();
                      }
                  }
              });
          }

          $('.wi-field-set').click(function () {
              // set action url
              var $form = jDOM($ar_code.val()).find('form');
              var action_url = $form.attr('action');
              var form_method = $form.attr('method') || 'post';
              form_method = form_method.toLowerCase();
              $('#ar_url').val(action_url);
              $('#ar_method').val(form_method);
          });
          $('.extracted-form_fields').on('click', '.wi-field-add', function () {
              if ($(this).data('hidden') === 'true') {
                  var field_names = $(this).data('names');
                  $hidden_fields_container.html('');
                  for (i in field_names) {
                      ar_add_form_field_hidden(i, field_names[i]);
                  }
              } else {
                  var field_ar_name = $(this).data('name');
                  if (is_field_name_in_form_builder(field_ar_name))
                      return false;
                  ar_add_form_field(field_ar_name);
              }
              // after adding new field, refresh states
              refresh_form_builder();
              hide_used_fields();
          });

          function is_field_name_in_form_builder(field_name) {
              var $_fields = $form_builder.find('input.field__ar-name');
              for (var i = 0; i < $_fields.length; i++) {
                  if ($_fields[i].value === field_name)
                      return true;
              }
              return false;
          }

          function ar_add_form_field_hidden(field_name, field_value) {
              var obtmp = $('#ar_templates .form-builder-hidden-field .field-block--table').clone();
              obtmp.find('.fieldblock__name').val(field_name);
              obtmp.find('.fieldblock__value').val(field_value);
              obtmp.appendTo($hidden_fields_container);
          }

          function ar_label_by_name(ar_name) {
              return $('#ar_templates .labels').find('.' + ar_name).val();
          }

          function ar_label_name_by_name(ar_name) {
              return $('#ar_templates .label_names').find('.' + ar_name).val();
          }

          function ar_add_form_field(field_ar_name, field_label, field_mapping) {
              var obtmp;
              obtmp = $('#ar_templates .form-builder .wi-form-fieldblock').clone().appendTo($form_builder);
              if (!!field_label)
                  obtmp.find('.field__label').val(field_label);
              if (!!field_ar_name) {
                  obtmp.find('.field__ar-name').val(field_ar_name);
                  var field_ar_label = ar_label_by_name(field_ar_name);
                  obtmp.find('.field__ar-label').val(field_ar_label);
                  obtmp.find('.field__label-name').val(ar_label_name_by_name(field_ar_name));
              }
              if (!!field_mapping) {
                  obtmp.find('.field__ar-mapping').mouseover().val(field_mapping);
              }
          }

          $form_builder.sortable();

          $form_builder.on('mouseover', '.field__ar-mapping', function () {
              var current_value = $(this).val();
              mappings = $('#ar_available_mappings').data('mappings');
              if (mappings) {
                  $(this).html('');
                  $(this).append($('<option>', {value: '', text: '* Not mapped'}));
                  for (i in mappings) {
                      $(this).append($('<option>', {value: mappings[i], text: mappings[i]}));
                  }
                  $(this).val(current_value);
              }
          });

          $form_builder.on('change', '.field__ar-mapping', function () {
              var $obj = $(this);
              var backup_value = $obj.val();
              $form_builder.find('.field__ar-mapping').each(function () {
                  if ($(this).val() === backup_value)
                      $(this).val('');
              });
              $obj.val(backup_value);
          });

          $form_builder.on('click', '.js__fieldblock-remove', function (event) {
              event.preventDefault();
              $(this).parents('.wi-form-fieldblock').remove();
              hide_used_fields();
          });

          $('.wi-form-fields--hidden').on('click', '.js__fieldblock-remove', function (event) {
              event.preventDefault();
              $(this).closest('.wi-form-fields--hidden').find('.fieldblock__content').html('');
              hide_used_fields();
          });

          function refresh_form_builder() {
              $form_builder.sortable('refresh');
          }

          function jDOM(html) {
              return $('<div>' + html + '</div>');
          }

          function get_form_fields($form) {
              return $($form.val()).find('input, textarea, select');
          }

          function generate_ar_settings() {
              $ar_settings.html('');
              $('<input>').attr('type', 'hidden').attr('name', 'ar_url').val($('#ar_url').val()).appendTo($ar_settings);
              $('<input>').attr('type', 'hidden').attr('name', 'ar_method').val($('#ar_method').val()).appendTo($ar_settings);
              $form_builder.find('.wi-form-fieldblock').each(function () {
                  var ar_mapping = $(this).find('.field__ar-mapping').val(),
                      ar_field_name = $(this).find('.field__ar-name').val(),
                      label_field_name = $(this).find('.field__label-name').val(),
                      label = $(this).find('.field__label').val();

                  $('<input>').attr('type', 'hidden').attr('name', 'ar_fields_order[]').val(ar_field_name).appendTo($ar_settings);
                  $('<input>').attr('type', 'hidden').attr('name', ar_field_name).val(ar_mapping).appendTo($ar_settings);
                  $('<input>').attr('type', 'hidden').attr('name', label_field_name).val(label).appendTo($ar_settings);
              });

              var hidden_fields = '';
              $('#wi-form-hidden-fields').children('.field-group').each(function () {
                  var value = $(this).find('.fieldblock__value').val(),
                      name = $(this).find('.fieldblock__name').val();

                  hidden_fields += $('<input>').attr('type', 'hidden').attr('name', name).val(value)[0].outerHTML;
              });
              $('<input>').attr('type', 'hidden').attr('name', 'ar_hidden').val(hidden_fields).appendTo($ar_settings);
          }

          // assign pre_save variable
          pre_save = function () {
              generate_ar_settings();
          };

          function update_ar_builder_from_settings() {
              var $ar_url = $ar_settings.find('[name="ar_url"]'),
                  $ar_method = $ar_settings.find('[name="ar_method"]'),
                  $ar_hidden = $ar_settings.find('[name="ar_hidden"]');

              if (!!$ar_url.val()) {
                  $('#ar_url').val($ar_url.val());
              }
              if (!!$ar_method) {
                  $('#ar_method').val($ar_method.val());
              }

              $ar_settings.find('[name^="ar_fields_order"]').each(function () {
                  var current_field = $(this).val();
                  if ($.inArray(current_field, ['ar_name', 'ar_lname', 'ar_email', 'ar_phone']) >= 0) {
                      _label_name = ar_label_name_by_name(current_field);
                      ar_add_form_field(current_field, $ar_settings.find('[name="' + _label_name + '"]').val(), $ar_settings.find('[name="' + current_field + '"]').val());
                  }
              });

              if (!!$ar_hidden) {
                  $hidden_fields = jDOM($ar_hidden.val()).find('input');
                  $hidden_fields_container.html('');
                  $hidden_fields.each(function () {
                      ar_add_form_field_hidden($(this).attr('name'), $(this).val());
                  });
              }
              //hide used fields from available fields
              hide_used_fields();
          }

          update_ar_builder_from_settings();
      }
    });
});
