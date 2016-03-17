<?php
ini_set('display_errors', 1);

require_once '../model/Email.php';
require_once '../dao/daoemail.php';

include 'default/top.php';

$daoEmail = DaoEmail::getInstance();

$emails = $daoEmail->SelecionaEmails();
?>
    <div>

    <!-- titulo -->
    <div class="page-title">
        <div class="title_left">
            <h3>
                Emais enviados
            </h3>
        </div>
    </div>

    <!-- tabela -->
    <div class="clearfix"></div>
    <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_content">
                <table id="example" class="table table-striped responsive-utilities jambo_table">
                    <thead>
                    <tr class="headings">
                        <th>#</th>
                        <th>Destinatário</th>
                        <th>Horário</th>
                        <th>Tipo</th>
                        <th class=" no-link last"><span class="nobr">Ações</span>
                        </th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php
                    foreach ($emails as $email):
                        if ($email->getSituacao() == 'Y') {
                            ?>
                            <tr class="even pointer">
                                <td class=" "><?= $email->getIdEmail(); ?></td>
                                <td class=" "><?php echo $email->getDestinatario(); ?></td>
                                <td class=" "><?php echo $email->getHorario(); ?></td>
                                <td class=" "><?php echo $email->getType(); ?></td>
                                <td class=" last"><a
                                        href="view_email.php?id=<?php echo $email->getIdEmail(); ?>">Ver</a>
                                </td>
                            </tr>
                        <?php }
                    endforeach; ?>
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