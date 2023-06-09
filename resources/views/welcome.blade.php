
@extends('layouts.material')
<!-- Content GRABS ALL SID BAR TOP BAR BOTTOM BAR, CHCOLATE BAR FROM LAYOUTS AND PAST CONTENT ON yield location in layout/xx.balde.php-->
@section('content')
<!-- Example usage in a Blade view -->
@if(session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


    <div class="col-md-12 mb-lg-0 mb-4">
      <div class="card mt-4">
        <div class="card-header pb-0 p-3">
          <div class="row">
            <div class="col-6 d-flex align-items-center">
              <h6 class="mb-0">Update from file</h6>
            </div>

            <div class="form-inline">

            <a href="{{ route('exportUser') }}" style="text-decoration: underline; color: green;">
  <span></span>
  <p>Download Template</p>
</a>
<form action="{{ route('PostUploadFile') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="input-group">
        <div class="input-group-append">
            <label for="fileInput" class="m-0">
                <button type="button" id="button1" class="btn btn-primary">Choose file</button>
            </label>
            <input id="fileInput" name="xlsx" type="file" style="display: none;">
        </div>

        <div class="input-group-prepend">
            <label for="fileInput" class="m-0">
                <button type="button" id="button2" class="btn btn-primary">Browse</button>
            </label>
        </div>
    </div>

    <div class="card-body p-3">
        <div class="row">
            <div class="col-md-6 mb-md-0 mb-4">
                <button type="submit" class="btn btn-outline-info w-100">Update</button>
            </div>
            <div class="col-md-6">
                <button type="button" class="btn btn-outline-danger w-100">Cancel</button>
            </div>
        </div>
    </div>
</form>




<script>
  const fileInput = document.getElementById('fileInput');
  const chooseFileButton1 = document.getElementById('button1');
  const chooseFileButton2 = document.getElementById('button2');
  const cancelButton = document.querySelector('.btn.btn-outline-danger');

  function handleClick() {
    fileInput.click();
  }

  function handleFileInputChange(event) {
    const selectedFile = event.target.files[0];
    chooseFileButton1.textContent = selectedFile ? selectedFile.name : 'Choose file';
  }

  function handleCancelClick() {
    fileInput.value = null;
    chooseFileButton1.textContent = 'Choose file';
    chooseFileButton2.textContent = 'Choose file';
  }

  fileInput.addEventListener('change', handleFileInputChange);
  chooseFileButton1.addEventListener('click', handleClick);
  chooseFileButton2.addEventListener('click', handleClick);
  cancelButton.addEventListener('click', handleCancelClick);
</script>



    <style>

          .form-inline .custom-file-input {
            height: 38px; /* Adjust the height as desired */
            border-radius: 0;
            border-color: grey;
            padding: 0;
          }

          .form-inline .custom-file.flex-grow-1 .custom-file-label.grey {
            border-color: black;
            cursor: pointer;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
          }

          .form-inline .input-group-append button {
            background-color: transparent;
            border: none;
            border-left: 1px solid grey;
            padding: 10;
            border-radius: 4px 0px 0px 4px;
            width: 1000px; /* Adjust the width as desired */
            height: 39px;
            text-align: left;
            color: grey;
            }   

          .form-inline .input-group-prepend button {
            border-radius: 0px 4px 4px 0px;
          }
    </style>




<!-- table start here  -->









      <div class="row">
        <div class="col-12">
          <div class="card my-4">

            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center justify-content-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Level</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Class</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Parent Contact</th>
                      <!-- <th></th> -->
                    </tr>
                  </thead>
                  <tbody>

                  @foreach($data as $row)

                  <tr>
                      <td>
                        <div class="d-flex px-2">
                          <div>
                          <!-- <i class='fas fa-address-card'></i> -->
                          </div>
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">{{$row->name}}</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">{{$row->level}}</p>
                      </td>
                      <td>
                        <span class="text-xs font-weight-bold">{{$row->class}}</span>
                      </td>
                      <td class="align-middle text-center">
                        <div class="d-flex align-items-center justify-content-center">
                          <span class="me-2 text-xs font-weight-bold">{{$row->parent_number}}</span>
                          <div>
                          </div>
                        </div>
                      </td>
                      <!-- <td class="align-middle">
                        <button class="btn btn-link text-secondary mb-0">
                          <i class="fa fa-ellipsis-v text-xs"></i>
                        </button>
                      </td> -->
                    </tr>

                  @endforeach







                    <!-- <tr>
                      <td>
                        <div class="d-flex px-2">
                          <div>
                            <img src="../assets/img/small-logos/logo-asana.svg" class="avatar avatar-sm rounded-circle me-2" alt="spotify">
                          </div>
                          <div class="my-auto">
                            <h6 class="mb-0 text-sm">Asana</h6>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">$2,500</p>
                      </td>
                      <td>
                        <span class="text-xs font-weight-bold">working</span>
                      </td>
                      <td class="align-middle text-center">
                        <div class="d-flex align-items-center justify-content-center">
                          <span class="me-2 text-xs font-weight-bold">60%</span>
                          <div>
                            <div class="progress">
                              <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;"></div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle">
                        <button class="btn btn-link text-secondary mb-0">
                          <i class="fa fa-ellipsis-v text-xs"></i>
                        </button>
                      </td>
                    </tr> -->
                   
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>


<!-- end content -->
@endsection