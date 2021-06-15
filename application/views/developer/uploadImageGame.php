<div class="container">
    <div class="row">
        <div class="col-md-10 mx-auto justify-content-center">
            <div class="img-profile">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <?php echo form_open_multipart('developer/uploadImageGame'); ?>
                        <input type="file" name="image_new" class="mb-4" />
                        <br />
                        <div class="col-md-12">
                            <div class="d-flex justify-content-center">
                                <input type="submit" value="Ubah" class="btn btn-primary" />
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>