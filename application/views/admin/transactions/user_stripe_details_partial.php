<?php if (isset($records) && count($records) > 0) { ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>User Name</th>
                <th>Stripe Email</th>
                <th>Stripe Account ID</th>
                <th>Restricted</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($records as $record) {
            ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $record->fullname ?></td>
                    <td><?php echo $record->stripe_id ?></td>
                    <td><?php echo $record->stripe_account_id ?></td>
                    <td>
                        <?php
                        if ($record->is_restricted != 'NA') :
                            if ($record->is_restricted) :
                                echo '<span class="badge badge-danger badge-pill">Yes</span>';
                            else :
                                echo '<span class="badge badge-success badge-pill">No</span>';
                            endif;
                        else :
                            echo 'NA';
                        endif;
                        ?>
                    </td>
                </tr>
            <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
<?php } else { ?>
    <div style="padding: 10px; text-align: center; color: #333;">No record found</div>
<?php } ?>