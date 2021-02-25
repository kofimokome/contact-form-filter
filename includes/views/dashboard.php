<?php
namespace kmcf7_message_filter;
?>

<style>
    .card {
        max-width: 100%;
    }
</style>
<div id="wrapper">

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page" style="margin-top:0; margin-left:0;">
        <div class="content">
            <?php if (!is_plugin_active('contact-form-7/wp-contact-form-7.php')): ?>
                <div class="alert alert-danger alert-dismissible">
                    <p><?php _e('Please Install / Enable Contact Form 7 Plugin First!', 'cf7-message-filter'); ?></p>
                </div>
            <?php endif; ?>
            <div class="alert alert-info alert-dismissible">
                <p>Hello There!. Thank for using this plugin. It will be great if you can take just 5 minutes of your
                    time to leave a review<br>
                    <a href="https://wordpress.org/support/plugin/cf7-message-filter/reviews/#new-post"
                       class="btn btn-success" target="_blank" rel="noopener noreferrer">Submit Reveiw</a>
                </p>
            </div>
            <div class="container-fluid">
                <div class="row page-title align-items-center">
                    <div class="col-sm-4 col-xl-6">
                        <h4 class="mb-1 mt-0">Dashboard</h4>
                    </div>

                </div>

                <!-- stats + charts -->
                <div class="row">
                    <div class="col-xl-5">
                        <div class="card">
                            <div class="card-body p-0">
                                <h5 class="card-title header-title border-bottom p-3 mb-0">Overview</h5>

                                <div class="row"><!-- stat 1 -->
                                    <div class="col-6 media px-3 py-4 border-bottom border-right">
                                        <div class="media-body">
                                            <h4 class="mt-0 mb-1 font-size-22 font-weight-normal"><?php echo get_option('kmcfmf_messages_blocked'); ?></h4>
                                            <span class="text-muted">Messages Blocked</span>
                                        </div>
                                        <!--                                    <i data-feather="users" class="align-self-center icon-dual icon-lg"></i>-->
                                    </div>

                                    <!-- stat 2 -->
                                    <div class="col-6 media px-3 py-4 border-bottom">
                                        <div class="media-body">
                                            <h4 class="mt-0 mb-1 font-size-22 font-weight-normal"><?php echo get_option('kmcfmf_messages_blocked_today'); ?></h4>
                                            <span class="text-muted"> Blocked Today</span>
                                        </div>
                                        <!--                                    <i data-feather="image" class="align-self-center icon-dual icon-lg"></i>-->
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- stats + charts -->
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body pb-0">
                                <h5 class="card-title mb-0 header-title">Weekly Statistics</h5>

                                <div id="stats-chart" class="apex-charts mt-3" dir="ltr"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-body pb-0">
                                <h5 class="card-title mb-0 header-title">Word Frequency</h5>

                                <div id="words-chart" class="apex-charts mt-3" dir="ltr"></div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- row -->
            </div>
        </div> <!-- content -->

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->


</div>
<?php $word_options = json_encode(array_keys(json_decode(get_option('kmcfmf_word_stats'), true))); ?>
<?php
$words = "[";
foreach (json_decode(get_option('kmcfmf_word_stats'), true) as $word) {
    $words .= $word . ",";
}
$words .= "]";
?>
<script>
    // start of transaction charts
    var options = {
        series: [{
            name: 'Messages blocked',
            data: <?php echo get_option('kmcfmf_weekly_stats')?>,
        }],
        chart: {
            height: 350,
            type: 'line',
        },
        stroke: {
            width: 7,
            curve: 'smooth'
        },
        xaxis: {
            type: 'text',
            categories: ['MON', 'TES', 'WED', 'THUR', 'FRI', 'SAT', 'SUN'],
        },
        title: {
            text: '',
            align: 'left',
            style: {
                fontSize: "16px",
                color: '#666'
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'dark',
                gradientToColors: ['#FDD835'],
                shadeIntensity: 1,
                type: 'horizontal',
                opacityFrom: 1,
                opacityTo: 1,
                stops: [0, 100, 100, 100]
            },
        },
        markers: {
            size: 4,
            colors: ["#FFA41B"],
            strokeColors: "#fff",
            strokeWidth: 2,
            hover: {
                size: 7,
            }
        },
        yaxis: {
            //min: -10,
            // max: 40,
            title: {
                text: 'Messages blocked',
            },
        }
    };

    var chart = new ApexCharts(document.querySelector("#stats-chart"), options);
    chart.render();

    var word_options = {
        series: <?php echo $words?>,
        chart: {
            width: 380,
            type: 'pie',
        },
        labels: <?php echo $word_options?>,
        responsive: [{
            breakpoint: 480,
            options: {
                chart: {
                    height: 350
                },
                legend: {
                    position: 'top'
                }
            }
        }]
    };

    var word_chart = new ApexCharts(document.querySelector("#words-chart"), word_options);
    word_chart.render();
</script>
<!-- END wrapper -->