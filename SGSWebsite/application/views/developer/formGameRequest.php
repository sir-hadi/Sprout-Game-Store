<div class="container">
    <div class="row mt-5">
        <div class="col-md-12">
            <h2 class="text-center">Create Request Game</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="<?= base_url('developer/gameRequest') ?>" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="developer_id">ID Developer</label>
                    <input type="text" name="developer_id" class="form-control" id="developer_id" value="<?= $developer['developer_id'] ?>">
                </div>
                <div class="form-group">
                    <label for="GameName">Game Name</label>
                    <input type="text" name="gameName" class="form-control" id="gameName">
                </div>
                <div class="form-group">
                    <label for="price">Price</label>
                    <input type="text" name="price" class="form-control" id="price">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <input type="text" name="description" class="form-control" id="description">
                </div>
                <!-- <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" class="form-control" id="image">
                </div> -->
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>