<?php
include "includes/header.php";
?>
<title> TEST PAGE</title>
<?php var_dump($_FILES) ?>
    <div class="container col">
    <!-- ##################### NORMAL FORM TESTS START #############################-->
    <div class="row">
        <br/>
        <br/>
    <form>
<h2> NORMAL FORM TESTS</h2>
        <fieldset>
            <legend>Legend</legend>
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" readonly="" class="form-control-plaintext" id="staticEmail" value="email@example.com">
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="exampleSelect1">Example select</label>
                <select class="form-control" id="exampleSelect1">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleSelect2">Example multiple select</label>
                <select multiple="" class="form-control" id="exampleSelect2">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
            <div class="form-group">
                <label for="exampleTextarea">Example textarea</label>
                <textarea class="form-control" id="exampleTextarea" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleInputFile">File input</label>
                <input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp">
                <small id="fileHelp" class="form-text text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small>
            </div>
            <fieldset class="form-group">
                <legend>Radio buttons</legend>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
                        Option one is this and that—be sure to include why it's great
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios2" value="option2">
                        Option two can be something else and selecting it will deselect option one
                    </label>
                </div>
                <div class="form-check disabled">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="optionsRadios" id="optionsRadios3" value="option3" disabled="">
                        Option three is disabled
                    </label>
                </div>
            </fieldset>
            <fieldset class="form-group">
                <legend>Checkboxes</legend>
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="" checked="">
                        Option one is this and that—be sure to include why it's great
                    </label>
                </div>
                <div class="form-check disabled">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="" disabled="">
                        Option two is disabled
                    </label>
                </div>
            </fieldset>
            <fieldset class="form-group">
                <legend>Sliders</legend>
                <label for="customRange1">Example range</label>
                <input type="range" class="custom-range" id="customRange1">
            </fieldset>
            <button type="submit" class="btn btn-primary">Submit</button>
        </fieldset>
    </form>
</div>
    <!-- ##################### NORMAL FORM TESTS END #############################-->

    <!-- ##################### VALIDATION FORM TESTS START  #############################-->
<div class="row">
    <form>
    <h2> NORMAL FORM TESTS</h2>
    <div class="form-group">
        <fieldset disabled="">
            <label class="control-label" for="disabledInput">Disabled input</label>
            <input class="form-control" id="disabledInput" type="text" placeholder="Disabled input here..." disabled="">
        </fieldset>
    </div>

    <div class="form-group">
        <fieldset>
            <label class="control-label" for="readOnlyInput">Readonly input</label>
            <input class="form-control" id="readOnlyInput" type="text" placeholder="Readonly input here..." readonly="">
        </fieldset>
    </div>

    <div class="form-group has-success">
        <label class="form-control-label" for="inputValid">Valid input</label>
        <input type="text" value="correct value" class="form-control is-valid" id="inputValid">
        <div class="valid-feedback">Success! You've done it.</div>
    </div>

    <div class="form-group has-danger">
        <label class="form-control-label" for="inputInvalid">Invalid input</label>
        <input type="text" value="wrong value" class="form-control is-invalid" id="inputInvalid">
        <div class="invalid-feedback">Sorry, that username's taken. Try another?</div>
    </div>

    <div class="form-group">
        <label class="col-form-label col-form-label-lg" for="inputLarge">Large input</label>
        <input class="form-control form-control-lg" type="text" placeholder=".form-control-lg" id="inputLarge">
    </div>

    <div class="form-group">
        <label class="col-form-label" for="inputDefault">Default input</label>
        <input type="text" class="form-control" placeholder="Default input" id="inputDefault">
    </div>

    <div class="form-group">
        <label class="col-form-label col-form-label-sm" for="inputSmall">Small input</label>
        <input class="form-control form-control-sm" type="text" placeholder=".form-control-sm" id="inputSmall">
    </div>

    <div class="form-group">
        <label class="control-label">Input addons</label>
        <div class="form-group">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">$</span>
                </div>
                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                <div class="input-group-append">
                    <span class="input-group-text">.00</span>
                </div>
            </div>
        </div>
        </form>
    </div>

    <!-- ##################### VALIDATION FORM TESTS END  #############################-->

<!-- ##################### BUTTON TESTS START  #############################-->

<div class="row">
    <h2> BUTTON TESTS</h2>
    <div class="">
    <div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Oh snap!</strong> <a href="#" class="alert-link">Change a few things up</a> and try submitting again.
    </div>
    </div>
</div>
    <!-- ##################### BUTTON TESTS END #############################-->

    <!-- ##################### TABLE TESTS START#############################-->
<div class="row">
    <table class="table table-sm">
    <h2> TABLE TESTS</h2>

        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">Handle</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td>Jacob</td>
            <td>Thornton</td>
            <td>@fat</td>
        </tr>
        <tr>
            <th scope="row">3</th>
            <td colspan="2">Larry the Bird</td>
            <td>@twitter</td>
        </tr>
        </tbody>
    </table>
</div>
    <!-- ##################### TABLE TESTS END #############################-->

    <!-- ##################### PAGENATION TESTS START #############################-->
<div class="row flex-row">
    <nav aria-label="Page navigation">
    <h2> PAGENATION TESTS</h2> <br/>
        <ul class="pagination justify-content-end">
            <li class="page-item disabled">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>

</div>
    <!-- ##################### PAGENATION TESTS END #############################-->

    <!-- ##################### FILE UPLOAD TESTS START #############################-->
    <h2> FILE UPLOAD TESTS</h2>
    <form class="form-signin" enctrype="multipart/form-data" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
        <div class="row">
        <input type="file" name="fileToUpload"  class="form-control" id="fileToUpload" placeholder="Choose file">
    <div>
    </div>
</div>
  <input type="submit"  value="Upload New File" name="submit"/>
        </form>
    <!-- ##################### FILE UPLOAD TESTS END #############################-->
<div> <!-- CONTAINER END-->


<?php

$email_address = "test_test";

if($_SERVER['REQUEST_METHOD']=="POST") {

    $file_path = "./files_uploaded/".$email_address."new_file.jpg";
    //Move the file from temp to the appropriate folder with new file name

   move_uploaded_file($_FILES[0], $file_path);
}
?>

<?php
include "includes/footer.php";
?>