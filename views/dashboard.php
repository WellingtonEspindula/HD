<?php
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
                                                <h3><?php echo $email->getDestinatario(); ?>
                                                    <small><?php echo $email->getHorario(); ?></small>
                                                </h3>
                                                <p>Ut enim ad minim veniam, quis nostrud exercitation enim ad minim
                                                    veniam,
                                                    quis nostrud exercitation...</p>
                                            </div>
                                        </div>
                                    <?php }
                                endforeach; ?>

                                <div class="mail_list">
                                    <div class="left">
                                        .
                                    </div>
                                    <div class="right">
                                        <h3>Debbis &amp; Raymond
                                            <small>4.09 PM</small>
                                        </h3>
                                        <p>Ut enim ad minim veniam, quis nostrud exercitation enim ad minim veniam, quis
                                            nostrud exercitation...</p>
                                    </div>
                                </div>
                                <div class="mail_list">
                                    <div class="left">
                                        <i class="fa fa-circle"></i> <i class="fa fa-edit"></i>
                                    </div>
                                    <div class="right">
                                        <h3>Dennis Mugo
                                            <small>3.00 PM</small>
                                        </h3>
                                        <p>Ut enim ad minim veniam, quis nostrud exercitation enim ad minim veniam, quis
                                            nostrud exercitation...</p>
                                    </div>
                                </div>
                                <div class="mail_list">
                                    <div class="left">
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="right">
                                        <h3>Jane Nobert
                                            <small>4.09 PM</small>
                                        </h3>
                                        <p>Ut enim ad minim veniam, quis nostrud exercitation enim ad minim veniam, quis
                                            nostrud exercitation...</p>
                                    </div>
                                </div>


                            </div>
                            <!-- /MAIL LIST -->

                            <?php
                                if (isset($_GET["id"])){
                                    
                                } else {

                                }

                            ?>
                            <!-- CONTENT MAIL -->
                            <div class="col-sm-9 mail_view">
                                <div class="inbox-body">
                                    <div class="mail_heading row">
                                        <div class="col-md-8">
                                            <div class="compose-btn">
                                                <a class="btn btn-sm btn-primary" href="mail_compose.html"><i
                                                        class="fa fa-reply"></i> Reply</a>
                                                <button title="" class="btn  btn-sm tooltips" type="button"
                                                        data-toggle="tooltip" data-original-title="Print"
                                                        data-placement="top"><i class="fa fa-print"></i></button>
                                                <button title="" class="btn btn-sm tooltips" data-toggle="tooltip"
                                                        data-original-title="Trash" data-placement="top"><i
                                                        class="fa fa-trash-o"></i>
                                                </button>
                                            </div>

                                        </div>
                                        <div class="col-md-4 text-right">
                                            <p class="date"> 8:02 PM 12 FEB 2014</p>
                                        </div>
                                        <div class="col-md-12">
                                            <h4> Donec vitae leo at sem lobortis porttitor eu consequat risus. Mauris
                                                sed congue orci. Donec ultrices faucibus rutrum.</h4>
                                        </div>
                                    </div>
                                    <div class="sender-info">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <strong>Jon Doe</strong>
                                                <span>(jon.doe@gmail.com)</span> to
                                                <strong>me</strong>
                                                <a class="sender-dropdown"><i class="fa fa-chevron-down"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="view-mail">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                            consequat.
                                            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore
                                            eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
                                            sunt in culpa qui officia deserunt mollit anim id est laborum. </p>
                                        <p>Riusmod tempor incididunt ut labor erem ipsum dolor sit amet, consectetur
                                            adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna
                                            aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                                            nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in
                                            reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                            pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                                            officia deserunt
                                            mollit anim id est laborum.</p>
                                        <p>Modesed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
                                            enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                                            aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                                            voluptate
                                            velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
                                            cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id
                                            est laborum.</p>
                                    </div>
                                    <div class="attachment">
                                        <p>
                                            <span><i class="fa fa-paperclip"></i> 3 attachments — </span>
                                            <a href="#">Download all attachments</a> |
                                            <a href="#">View all images</a>
                                        </p>
                                        <ul>
                                            <li>
                                                <a class="atch-thumb" href="#">
                                                    <img alt="img" src="images/1.png">
                                                </a>

                                                <div class="file-name">
                                                    image-name.jpg
                                                </div>
                                                <span>12KB</span>


                                                <div class="links">
                                                    <a href="#">View</a> -
                                                    <a href="#">Download</a>
                                                </div>
                                            </li>

                                            <li>
                                                <a class="atch-thumb" href="#">
                                                    <img alt="img" src="images/1.png">
                                                </a>

                                                <div class="file-name">
                                                    img_name.jpg
                                                </div>
                                                <span>40KB</span>

                                                <div class="links">
                                                    <a href="#">View</a> -
                                                    <a href="#">Download</a>
                                                </div>
                                            </li>
                                            <li>
                                                <a class="atch-thumb" href="#">
                                                    <img alt="img" src="images/1.png">
                                                </a>

                                                <div class="file-name">
                                                    img_name.jpg
                                                </div>
                                                <span>30KB</span>

                                                <div class="links">
                                                    <a href="#">View</a> -
                                                    <a href="#">Download</a>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="compose-btn pull-left">
                                        <a class="btn btn-sm btn-primary" href="mail_compose.html"><i
                                                class="fa fa-reply"></i> Reply</a>
                                        <button class="btn btn-sm "><i class="fa fa-arrow-right"></i> Forward</button>
                                        <button title="" class="btn  btn-sm tooltips" type="button"
                                                data-toggle="tooltip" data-original-title="Print" data-placement="top">
                                            <i class="fa fa-print"></i></button>
                                        <button title="" class="btn btn-sm tooltips" data-toggle="tooltip"
                                                data-original-title="Trash" data-placement="top"><i
                                                class="fa fa-trash-o"></i>
                                        </button>
                                    </div>
                                </div>

                            </div>
                            <!-- /CONTENT MAIL -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php
include 'default/bottom.php';
?>