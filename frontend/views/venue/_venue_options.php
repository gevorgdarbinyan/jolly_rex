<div>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="venueOptionsBlockHeading">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" href="#venueOptionsBlock" aria-expanded="false" aria-controls="venueOptionsBlock">
                        Rooms
                        <span class="glyphicon glyphicon-menu-down pull-right"></span>
                    </a>
                </h4>
            </div>
            <div id="venueOptionsBlock" class="collapse">
                <div class="panel-body">
                    <table class="table table-borderedless">
                        <tr>
                            <td>Room</td>
                            <td>Price</td>
                            <td>Description</td>
                        </tr>
                    <?php foreach($venueOptionsData as $venueOptions): ?>
                        <tr>
                            <td><?=$venueOptions['name'];?></td>
                            <td><?=' £'.$venueOptions['price'].'/'.$venueOptions['hour'].' hour';?></td>
                            <td><?=$venueOptions['description'];?></td>
                        </tr>
                   <?php endforeach;?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>