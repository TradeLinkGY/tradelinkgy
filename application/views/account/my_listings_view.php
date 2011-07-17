<div id="content">
    <h2>My Listings</h2>
    <table id="area-listing-table">
        <thead>
            <tr>
                <th class="table-listing-id">ID</th>
                <th class="table-listing-name">Listing Name</th>
                <th class="table-listing-activity">Activity Period</th>
                <th class="table-listing-status">Status</th>
                <th class="table-listing-operations">Operations</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                
            </tr>
        </tfoot>
        <tbody>
            <?php foreach ($listings['rows'] as $row): ?>
            <tr>
                <td><p><?= $row->id_listing ?></p></td>
                <td><p><?= $row->listing_name ?></p></td>
                <td><p>Created: <?= $row->listing_created ?></p><p>Expiring: <?= $row->listing_expiry; ?></p></td>
                <td><p><?= $row->listing_status ?></p></td>
                <td><p>Edit | Make Active/Inactive | Add Photos</p></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <?php if (strlen($pagination)): ?>
        <span class="pagination-link">
            Pages: <?= $pagination; ?>
        </span>
    <?php endif; ?>
    
</div>


<style type="text/css">
    table.sample {
        border-width: 1px;
        border-spacing: 0px;
        border-style: solid;
        border-color: gray;
        border-collapse: collapse;
        background-color: white;
    }
    table.sample th {
        border-width: 1px;
        padding: 4px;
        border-style: inset;
        border-color: gray;
        background-color: white;
        -moz-border-radius: ;
    }
    table.sample td {
        border-width: 1px;
        padding: 4px;
        border-style: inset;
        border-color: gray;
        background-color: white;
        -moz-border-radius: ;
    }
</style>