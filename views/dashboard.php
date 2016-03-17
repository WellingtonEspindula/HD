<?php
ini_set('display_errors', 1);

require_once '../model/Email.php';
require_once '../dao/daoemail.php';

include 'default/top.php';

$daoEmail = DaoEmail::getInstance();

$emails = $daoEmail->SelecionaEmails();
?>
    <div>

        <div class="page-title">
            <div class="title_left">
                <h3>
                    Emais enviados
                </h3>
            </div>

            <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Search for...">
                  <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Ir!</button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>

        <div class="row">

            <div class="col-md-12">
                <div class="x_panel">
                    <div class="x_content">
                        <div class="row">
                            <div class="col-sm-3 mail_list_column">
                                <?php
                                foreach ($emails as $email):
                                    if ($email->getSituacao() == 'Y') {
                                        ?>
                                        <div class="mail_list">
                                            <div class="right">
                                                <h3><a href="dashboard.php?id=<?php echo $email->getIdEmail(); ?>">
                                                        <?php echo $email->getDestinatario(); ?>
                                                    </a>
                                                    <small><?php echo $email->getHorario(); ?></small>
                                                </h3>
                                                <p><?php echo $email->getType(); ?></p>
                                            </div>
                                        </div>
                                    <?php }
                                endforeach; ?>


                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="page-title">
        <div class="title_left">
            <h3>
                Invoice
                <small>
                    Some examples to get you started
                </small>
            </h3>
        </div>

        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                  <span class="input-group-btn">
                            <button class="btn btn-default" type="button">Go!</button>
                        </span>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>

    <div class="row">

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <table id="example" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                    <tr class="headings">
                        <th>Invoice</th>
                        <th>Invoice Date</th>
                        <th>Order</th>
                        <th>Bill to Name</th>
                        <th>Status</th>
                        <th>Amount</th>
                        <th class=" no-link last"><span class="nobr">Action</span>
                        </th>
                    </tr>
                    </thead>

                    <tbody>
                    <tr class="even pointer">
                        <td class=" ">121000040</td>
                        <td class=" ">May 23, 2014 11:47:56 PM</td>
                        <td class=" ">121000210 <i class="success fa fa-long-arrow-up"></i>
                        </td>
                        <td class=" ">John Blank L</td>
                        <td class=" ">Paid</td>
                        <td class="a-right a-right ">$7.45</td>
                        <td class=" last"><a href="#">View</a>
                        </td>
                    </tr>
                    <tr class="odd pointer">
                        <td class=" ">121000039</td>
                        <td class=" ">May 23, 2014 11:30:12 PM</td>
                        <td class=" ">121000208 <i class="success fa fa-long-arrow-up"></i>
                        </td>
                        <td class=" ">John Blank L</td>
                        <td class=" ">Paid</td>
                        <td class="a-right a-right ">$741.20</td>
                        <td class=" last"><a href="#">View</a>
                        </td>
                    </tr>
                    <tr class="even pointer">
                        <td class=" ">121000038</td>
                        <td class=" ">May 24, 2014 10:55:33 PM</td>
                        <td class=" ">121000203 <i class="success fa fa-long-arrow-up"></i>
                        </td>
                        <td class=" ">Mike Smith</td>
                        <td class=" ">Paid</td>
                        <td class="a-right a-right ">$432.26</td>
                        <td class=" last"><a href="#">View</a>
                        </td>
                    </tr>
                    </tbody>

                </table>
            </div>
        </div>
    </div>

    <!-- bootstrap progress js -->
    <script src="<?php echo BASE_URL ?>/static/js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="<?php echo BASE_URL ?>/static/js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="<?php echo BASE_URL ?>/static/js/icheck/icheck.min.js"></script>

    <script src="<?php echo BASE_URL ?>/static/js/custom.js"></script>


    <!-- Datatables -->
    <script src="<?php echo BASE_URL ?>/static/js/datatables/js/jquery.dataTables.js"></script>
    <script src="<?php echo BASE_URL ?>/static/js/datatables/tools/js/dataTables.tableTools.js"></script>

    <!-- pace -->
    <script src="<?php echo BASE_URL ?>/static/js/pace/pace.min.js"></script>
    <script>
        $(document).ready(function () {
            $('input.tableflat').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });
        });

        var asInitVals = new Array();
        $(document).ready(function () {
            var oTable = $('#example').dataTable({
                "oLanguage": {
                    "sSearch": "Search all columns:"
                },
                "aoColumnDefs": [{
                    'bSortable': false,
                    'aTargets': [0]
                } //disables sorting for column one
                ],
                'iDisplayLength': 12,
                "sPaginationType": "full_numbers",
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "<?php echo BASE_URL; ?>/static/js/datatables/tools/swf/copy_csv_xls_pdf.swf"
                }
            });
            $("tfoot input").keyup(function () {
                /* Filter on the column based on the index of this element's parent <th> */
                oTable.fnFilter(this.value, $("tfoot th").index($(this).parent()));
            });
            $("tfoot input").each(function (i) {
                asInitVals[i] = this.value;
            });
            $("tfoot input").focus(function () {
                if (this.className == "search_init") {
                    this.className = "";
                    this.value = "";
                }
            });
            $("tfoot input").blur(function (i) {
                if (this.value == "") {
                    this.className = "search_init";
                    this.value = asInitVals[$("tfoot input").index(this)];
                }
            });
        });
    </script>

<?php
include 'default/bottom.php';
?>