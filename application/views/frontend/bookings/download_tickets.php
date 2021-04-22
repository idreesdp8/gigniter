<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Label</title>
    <style>
        @media print {
            @page {
                margin: 0;
            }

            .print-page {
                width: 100%;
                height: 100%;
                padding-right: 2.032em !important;
                padding-left: 2.032em !important;
                box-sizing: border-box;
            }
        }
    </style>
</head>

<body>
    <div class="print-page" style="padding: 1.25rem;">
        <?php
        if ($tickets) :
            foreach ($tickets as $ticket) :
        ?>
                <div class="card">
                    <div class="card-body">
                        <div class="title"><?php echo $ticket->ticket_no ?></div>
                        <!-- <div>
                            <img src="<?php echo $ticket->barcode ?>" alt="">
                        </div> -->
                        <div>
                            <?php echo $ticket->gig->title; ?>
                        </div>
                        <div>
                            <?php echo $ticket->ticket_tier->name; ?>
                        </div>
                        <div>
                            <?php echo $ticket->booking->booking_no; ?>
                        </div>
                        <div>
                            <?php echo $ticket->user->fname.' '.$ticket->user->lname ?>
                        </div>
                    </div>
                </div>
        <?php
            endforeach;
        endif;
        ?>
    </div>

    <script>
        // jQuery(document).ready(function() {
        window.print();
        // history.back();
        // });
    </script>
</body>

</html>