jQuery(function ($) {
    window.rangeTools = {
        setVal: function ($select, text) {
            $select.val($select.find('option').filter(function () {
                return $(this).html() == text;
            }).val());
        },

        ladda: function (elem) {
            var ladda = Ladda.create(elem);
            ladda.start();
            return ladda;
        },

        hideUp24Hours: function ($start, $end) {
            $start.on('change', function () {
                var $start = $(this),
                    start_time = $start.val();

                // Hide end time options to keep them within 24 hours after start time.
                var parts = start_time.split(':');
                parts[0] = parseInt(parts[0]) + 24;
                var end_time = parts.join(':');
                var frag = document.createDocumentFragment();
                var old_value = $end.val();
                var new_value = null;
                $('option', $end).each(function () {
                    if (this.value <= start_time || this.value > end_time) {
                        var span = document.createElement('span');
                        span.style.display = 'none';
                        span.appendChild(this.cloneNode(true));
                        frag.appendChild(span);
                    } else {
                        frag.appendChild(this.cloneNode(true));
                        if (new_value === null || old_value == this.value) {
                            new_value = this.value;
                        }
                    }
                });
                $end.empty().append(frag).val(new_value);

                // when the working day is disabled (working start time is set to 'OFF')
                // hide all the elements inside the row
                if (!$start.val()) {
                    $start.closest('.row').find('.bookly-hide-on-off').hide();
                } else {
                    $start.closest('.row').find('.bookly-hide-on-off').show();
                }
            }).trigger('change');
        },

        // Hide unavailable time in range
        hideInaccessibleBreaks: function ($start, $end, force_keep_values) {
            var $row = $start.closest('.bookly-range-row'),
                $main_range_beg = $row.find('.parent-range-beg'),
                $main_range_end = $row.find('.parent-range-end'),
                frag1 = document.createDocumentFragment(),
                frag2 = document.createDocumentFragment(),
                old_value = $start.val(),
                new_value = null;
            $('option', $start).each(function () {
                if ((this.value < $main_range_beg.val() || this.value >= $main_range_end.val()) && (!force_keep_values || this.value != old_value)) {
                    var span = document.createElement('span');
                    span.style.display = 'none';
                    span.appendChild(this.cloneNode(true));
                    frag1.appendChild(span);
                } else {
                    frag1.appendChild(this.cloneNode(true));
                    if (new_value === null || old_value == this.value) {
                        new_value = this.value;
                    }
                }
            });
            $start.empty().append(frag1).val(new_value);

            old_value = $end.val();
            new_value = null;
            $('option', $end).each(function () {
                if ((this.value <= $start.val() || this.value > $main_range_end.val()) && (!force_keep_values || this.value != old_value)) {
                    var span = document.createElement('span');
                    span.style.display = 'none';
                    span.appendChild(this.cloneNode(true));
                    frag2.appendChild(span);
                } else {
                    frag2.appendChild(this.cloneNode(true));
                    if (new_value === null || old_value == this.value) {
                        new_value = this.value;
                    }
                }
            });
            $end.empty().append(frag2).val(new_value);
        }
    }
});