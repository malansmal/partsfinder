<?php $__env->startSection('email-body'); ?>

    <tr>
        <td class="body" width="100%" cellpadding="0" cellspacing="0">
            <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0">
                <!-- Body content -->
                <tr>
                    <td class="content-cell">

                        <h1 class="greet-ok">Dear <?php echo e($name); ?></h1>

                        <p>Thank you for submitting a request for parts wanted. Your request will be send to all our suppliers 
						throughout South Africa. You will receive a notification to view your request online
						from suppliers if parts are available. Click on the following link to view all quote from suppliers. 
						Please allow for other suppliers to also quote.</p><br/>
                        <p>Request No: <?php echo e($requestNo); ?></p>
                        <br/><a href="<?php echo e($link); ?>">View Quote</a>
						<br/>
                        <p>This is an automated e-mail, Please do not reply to this e-mail.</p>

                        <p>
                            Regards,<br>
                            <?php echo e(getApplicationName()); ?> Team
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('e_mail.layout.email_layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>