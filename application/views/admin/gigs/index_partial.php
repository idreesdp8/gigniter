<table class="table table-striped datatable-custom">
    <?php if (isset($records) && count($records) > 0) { ?>
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Title</th>
                <th>Category</th>
                <th>Genre</th>
                <th>Popularity</th>
                <th>Concert Date</th>
                <th>Satus</th>
                <th>Featured</th>
                <th>Booked</th>
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
                    <td><?php echo $record->user_name ?></td>
                    <td><?php echo $record->title ?></td>
                    <td><?php echo $record->category_label ?></td>
                    <td><?php echo $record->genre_label ?></td>
                    <td><?php echo $record->popularity ?></td>
                    <td><?php echo $record->gig_date ? date('M d, Y', strtotime($record->gig_date)) : 'NA' ?></td>
                    <td>
                        <?php
                        if ($record->status == 0) :
                            $badge_class = 'badge-danger';
                        elseif ($record->status == 1) :
                            $badge_class = 'badge-success';
                        elseif ($record->status == 2) :
                            $badge_class = 'badge-primary';
                        elseif ($record->status == 3) :
                            $badge_class = 'badge-secondary';
                        endif;
                        ?>
                        <span class="badge <?php echo $badge_class ?>"><?php echo $record->status_label ?></span>
                    </td>
                    <td>
                        <?php
                        if ($record->is_featured) :
                        ?>
                            <span class="badge badge-success">Yes</span>
                        <?php
                        else :
                        ?>
                            <span class="badge badge-danger">No</span>
                        <?php
                        endif;
                        ?>
                    </td>
                    <td><?php echo round($record->booked, 0) ?>%</td>
                    <td><?php echo date('M d, Y', strtotime($record->created_on)) ?></td>
                    <td>
                        <div class="d-flex">
                            <!-- <button type="button" data-toggle="modal" data-target="#showModal" class="btn btn-info btn-icon showModal" data-value=<?php //echo $record->id 
                                                                                                                                                        ?>><i class="icon-search4"></i></button> -->
                            <a href="<?php echo admin_base_url() ?>gigs/update/<?php echo $record->id ?>" type="button" class="btn btn-primary btn-icon ml-2"><i class="icon-pencil7"></i></a>
                            <form action="<?php echo admin_base_url() ?>gigs/trash/<?php echo $record->id ?>">
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