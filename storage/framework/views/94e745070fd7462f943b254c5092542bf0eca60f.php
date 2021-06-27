<?php $__env->startSection('email-body'); ?>

    <tr>
        <td class="body" width="100%" cellpadding="0" cellspacing="0">
            <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0">
                <!-- Body content -->
                <tr>
                    <td class="content-cell">

                        <h1 class="greet-ok">Dear, <?php echo e($name); ?>!</h1>

                        <p>Please be informed that one of our user submitted parts request. Please click on the link to view the parts and quote.</p><br/>
                        <p>Please only enter prices for parts available and attach photo if available. Keep in mind quote will expire in 48hours.</p>
                        <br/><br/><a href="<?php echo e($link); ?>" class='button button-blue'>Quote Now</a>

                        <p>This is an automated e-mail, Please do not reply to this e-mail.</p>

                        <p>
                            Regards,<br>
                            <?php echo e(getApplicationName()); ?> administrator team
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('e_mail.layout.email_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>