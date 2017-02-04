<h1>Eseménynapló</h1>
<table class="table table-striped table-hover display" id="events">
    <thead>
        <tr>
            <th>#</th>
            <th>Dátum</th>
            <th>Felhasználó</th>
            <th>Esemény</th>
        </tr>
    </thead>
    <tbody>
        <?php
foreach(getEvents() as $e){
?>
            <tr>
                <td scope="row">
                    <?=$e['ID']?>
                </td>
                <td style="white-space:nowrap;">
                    <?=$e['Timestamp']?>
                </td>
                <td style="white-space:nowrap;">
                    <?=getUserDataById($e['UserID'])['TeljesNev']?>
                </td>
                <td>
                    <?=$e['Action'].(substr($e['Action'],-1) == ':' ? 
                       ($e['OldValue']=='' ? ' '.$e['NewValue'] :' '.$e['OldValue'].' => '.$e['NewValue'])
                            :
                       '')?>
                </td>
            </tr>
            <?php
}
?>
    </tbody>
</table>

<script>
    $(document).ready(function () {
        $('#events').DataTable({
            "scrollX": true,
            "lengthMenu": [[30, 100, 250, 500, -1], [30, 100, 250, 500, "minden"]],
            "language": {
                "decimal": "",
                "emptyTable": "Nincs adat",
                "info": "Megjelenítve: _START_ és _END_ között, összesen _TOTAL_ adatsor",
                "infoEmpty": "Nincs megjeleníthető adatsor",
                "infoFiltered": "(_MAX_ adatsorból szűrve)",
                "infoPostFix": "",
                "thousands": ".",
                "lengthMenu": "Mutass _MENU_ eseményt",
                "loadingRecords": "Betöltés...",
                "processing": "Feldolgozás...",
                "search": "Keresés:",
                "zeroRecords": "Nincs találat",
                "paginate": {
                    "first": "Első",
                    "last": "Utolsó",
                    "next": "Következő",
                    "previous": "Előző"
                },
            },
            "paging": true,
            "info": true,
            "columns": [
                {
                    "searchable": false,
                },
                null,
                null,
                null
            ],
            "order": [[1, "desc"]]
        });
    });
</script>