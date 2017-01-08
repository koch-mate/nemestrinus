<h1>Eseménynapló</h1>

<table class="table table-striped table-hover display" id="users">
    <thead>
        <tr>
            <th>#</th>
            <th>Dátum</th>
            <th>Felhasználó</th>
            <th>Esemény</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td scope="row">1</td>
            <td>2016-09-12 12:23:34</td>
            <td>Példa Pál</td>
            <td>Új megrendelés felvétele (adatok: ...)</td>
        </tr>
        <tr>
            <td scope="row">2</td>
            <td>2016-09-12 12:12:43</td>
            <td>Példa Pál</td>
            <td>Megrendelés módosítása (adatok: ...)</td>
        </tr>
        <tr>
            <td scope="row">3</td>
            <td>2016-09-12 12:01:11</td>
            <td>Példa Pál</td>
            <td>Bejelentkezés</td>
        </tr>
        <tr>
            <td scope="row">4</td>
            <td>2016-09-11 07:23:34</td>
            <td>Admin</td>
            <td>Új felhasználó felvétele (adatok: ...)</td>
        </tr>
        <tr>
            <td scope="row">5</td>
            <td>2016-09-11 07:11:01</td>
            <td>Admin</td>
            <td>Bejelentkezés</td>
        </tr>
    </tbody>
</table>

<script>
    $(document).ready(function () {
        $('#users').DataTable({
            "lengthMenu": [[100, 250, 500, -1], [100, 250, 500, "minden"]],
            "language": {
                "decimal": "",
                "emptyTable": "Nincs adat",
                "info": "Megjelenítve: _START_ és _END_ között, összesen _TOTAL_ adatsor",
                "infoEmpty": "Nincs megjeleníthető adatsor",
                "infoFiltered": "(_MAX_ adatsorból szűrve)",
                "infoPostFix": "",
                "thousands": ".",
                "lengthMenu": "Mutass _MENU_ elemet",
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
                "aria": {
                    "sortAscending": ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                }
            },
            "paging": true,
            "info": true,
            "columns": [
                {
                    "searchable": false
                },
                null,
                null,
                null
            ]
        });
    });
</script>