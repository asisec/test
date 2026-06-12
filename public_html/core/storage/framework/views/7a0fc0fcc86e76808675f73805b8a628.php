
<script src="<?php echo e(asset('assets/backend/js/map/raphael.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/js/map/jquery.mapael.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/js/map/world_countries.js')); ?>"></script>

<script>
    $(function () {
        var visitors = <?php echo json_encode($visitors); ?>;
        var countryCodes = <?php echo json_encode($countryCodes); ?>;

        var plots = {};
        var areas = {};

        // Process each visitor data
        visitors.forEach(function(visitor, index) {
            var plotKey = 'plot' + index;
            plots[plotKey] = {
                latitude: parseFloat(visitor.latitude) || 0,
                longitude: parseFloat(visitor.longitude) || 0,
                value: visitor.total || 0,
                tooltip: {
                    content: visitor.country + "<br /><?php echo e(__('Total visitors')); ?>: " + visitor.total
                }
            };
        });

        visitors.forEach(function(visitor, index) {
            var countryCode = countryCodes[visitor.country_code];
            if (countryCode) {
                if (countryCode && countryCode.country_code) {
                    var countryCodeKey = countryCode.country_code;
                    areas[countryCodeKey] = {
                        value: visitor.total.toString(),
                        attrs: {
                            href: "#"
                        },
                        tooltip: {
                            content: "<span style=\"font-weight:bold;\">" + visitor.country + "<\/span><br \/><?php echo e(__('Total Visitors')); ?>: " + visitor.total
                        }
                    };
                }
            }
        });


        $(".countryMap").mapael({
            map: {
                name: "world_countries",
                defaultArea: {
                    attrs: {
                        stroke: "#fff",
                        "stroke-width": 1
                    }
                }
            },
            legend: {
                areas: {
                    title: "<?php echo e(__("Total Visitor Country Wise")); ?>",
                    slices: [
                        {
                            min: 1,
                            max: 10,
                            attrs: {
                                fill: "#6aafe1"
                            },
                            label: "<?php echo e(__("1-10 visitors")); ?>"
                        },
                        {
                            min: 11,
                            max: 50,
                            attrs: {
                                fill: "#459bd9"
                            },
                            label: "<?php echo e(__("11-50 visitors")); ?>"
                        },
                        {
                            min: 51,
                            max: 100,
                            attrs: {
                                fill: "#2579b5"
                            },
                            label: "<?php echo e(__("51-100 visitors")); ?>",
                            clicked: true
                        },
                        {
                            min: 101,
                            attrs: {
                                fill: "#1a527b"
                            },
                            label: "<?php echo e(__("101+ visitors")); ?>"
                        }
                    ]
                }
            },
            plots: plots,
            areas: areas
        });
    });
</script>







<?php /**PATH /home/textileforum/htdocs/textileforum.net/public_html/core/resources/views/backend/pages/dashboard/visitors-by-country-js.blade.php ENDPATH**/ ?>