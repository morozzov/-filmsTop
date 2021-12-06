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
        <tbody>

        <?php foreach ($data as $film): ?>
            <tr>
                <th scope="row"><?= $film->Id ?></th>
                <td><?= $film->Name ?></td>
                <td><?= $film->Year ?></td>
                <td>@<?= $film->UserId ?></td>

            </tr>
        <?php endforeach; ?>
        <tr class="table-light">
            <form method="post" action="/films/addNew">
                <td><button class="btn btn-outline-dark m-0 p-o" type="submit">Add</button></td>
                <td><input name="name" type="text" class="form-control bg-transparent border-dark" placeholder="Name"></td>
                <td><input name="year" type="number" min="1895" max="2099" step="1" class="form-control bg-transparent border-dark" placeholder="Year"></td>
                <td></td>
            </form>
        </tr>
        </tbody>
    </table>
</article>