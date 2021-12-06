<article class="card-body">
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Year</th>
            <th scope="col">UserId</th>
        </tr>
        </thead>
        <tbody id="table">

        <?php foreach ($data as $film): ?>
            <tr>
                <th scope="row"><?= $film->Id ?></th>
                <td><?= $film->Name ?></td>
                <td><?= $film->Year ?></td>
                <td>@<?= $film->UserId ?></td>
            </tr>
        <?php endforeach; ?>
        </tr>
        </tbody>


        <tbody>
        <tr class="table-light">
            <script>
                $(function () {
                    $('form').on('submit', function (e) {
                        e.preventDefault();
                        if ($("#name").val() != "" && $("#year").val() != "") {
                            $.ajax({
                                type: 'post',
                                url: '/films/addNew',
                                data: $('form').serialize(),
                                success: function (data) {
                                    $('#table').append("<tr><th scope='row'>" + data + "</th><td>" + $("#name").val() + "</td><td>" + $("#year").val() + "</td><td>" + "@" + <?= $_SESSION['user_id'] ?> + "</td></tr>")
                                }
                            });
                        } else {
                            alert("Enter name and year of film")
                        }
                    });

                });
            </script>
            <form method="post" id="form" action="/films/addNew">
                <td>
                    <button class="btn btn-outline-dark m-0 p-o" type="submit">Add</button>
                </td>
                <td><input name="name" id="name" type="text" class="form-control bg-transparent border-dark"
                           placeholder="Name"></td>
                <td><input name="year" id="year" type="number" min="1895" max="2099" step="1"
                           class="form-control bg-transparent border-dark" placeholder="Year"></td>
                <td></td>
            </form>
        </tr>
        </tbody>
    </table>
</article>