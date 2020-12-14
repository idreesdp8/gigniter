<table class="table table-striped">
    <?php if (isset($records) && count($records) > 0) { ?>
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Address</th>
                <th>Status</th>
                <th>Added on</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($records as $record) {
            ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $record->fname . ' ' . $record->lname ?></td>
                    <td><a href="javascript:void(0)"><?php echo $record->email ?></a></td>
                    <td><?php echo $record->role_name ?></td>
                    <td><?php echo $record->address ?></td>
                    <td>
                        <?php if ($record->status) : ?>
                            <span class="badge badge-success">Active</span>
                        <?php else : ?>
                            <span class="badge badge-danger">Inactive</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo date('M d, Y H:i A', strtotime($record->created_on)) ?></td>
                    <td>
                        <div class="d-flex">
                            <a href="<?php echo admin_base_url() ?>users/update/<?php echo $record->id ?>" type="button" class="btn btn-primary btn-icon"><i class="icon-pencil7"></i></a>
                            <form action="<?php echo admin_base_url() ?>users/trash/<?php echo $record->id ?>">
                                <button type="submit" class="btn btn-danger btn-icon ml-2"><i class="icon-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php
                $i++;
            }
            ?>
        </tbody>
    <?php } else { ?>
        <div style="padding: 10px; text-align: center; color: #333;">No record found</div>
    <?php } ?>
</table>