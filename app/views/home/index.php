<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nhật Ký Mỗi Ngày</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&display=swap');

    html,
    body {
      font-family: 'Barlow', sans-serif;
    }

    #btn-add {
      position: absolute;
      right: 20px;
      bottom: 20px;
      width: 50px;
      border-radius: 50px;
      height: 50px;
    }
  </style>
</head>

<body>
  <div class="container mt-3">
    <div class="d-flex justify-content-between align-items-center">
      <h1>Nhật Ký Mỗi Ngày</h1>
      <div id="auth">
        <?php if (!empty($_SESSION['user'])) { ?>
          <button type="button" id="logout" class="btn btn-primary btn-lg">
            Logout
          </button>
        <?php } else { ?>
          <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#login">
            Login
          </button>
        <?php } ?>
      </div>
    </div>

    <div class="contents" id="contents">

      <?php
      if (!empty($this->data['contents'])) {
        foreach ($this->data['contents'] as $c) {
          extract($c);
      ?>
          <div data-id="<?= $id ?>" class="py-2">
            <div class="alert alert-primary d-flex justify-content-between" data-id="<?= $id ?>" role="alert">
              <strong><?= $content ?></strong>
              <div class="border border-primary p-1 ml-3 rounded"> <span><?= $create_at ?>
                  <br>
                  Nguyen Van Thao
                </span>
              </div>
            </div>

            <?php
            if (!empty($_SESSION['user'])) { ?>
              <div class="d-flex justify-content-end">
                <button type="button" onclick="detail(<?= $id ?>)" class="btn btn-primary btn-lg m-1 " data-toggle="modal" data-target="#modalEdit">
                  Edit
                </button>
                <button type="button" onclick="deleteE(<?= $id ?>)" class="btn btn-danger btn-lg m-1" data-toggle="modal" data-target="#modalDelete">
                  Delete
                </button>
              </div>
            <?php } ?>
          </div>
        <?php }
      } else { ?>
        <div class="alert alert-primary d-flex justify-content-between" role="alert">
          <strong>Nhat ky khong con gi nua</strong>
          <div class="border border-primary p-1 ml-3 rounded"> <span> <?= date('Y-m-d H:i:s') ?></span>
          </div>
        </div>
      <?php } ?>
    </div>

    <button id="btn-add" type="button" class="btn btn-primary" data-toggle="modal" data-target="<?= $_SESSION['user'] ? '#modalAdd' : "#login" ?>">+</button>
  </div>




  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" name="content" id="content" rows="3"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <h3>Delete ?
          </h3>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-danger">Delete</button>
        </div>
      </div>
    </div>
  </div>



  <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" name="content" id="content" rows="3"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </div>
    </div>
  </div>


  <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <form method="post" id="login">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <div id="top">

            </div>
            <div class="container-fluid">
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" class="form-control" placeholder="">
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Login</button>
          </div>
        </div>
      </form>
    </div>
  </div>




  <script>
    let id_content = null;

    function detail(id) {
      id_content = id;
      $.ajax({
        type: "POST",
        url: window.location.href,
        data: {
          method_type: 'detail',
          id: id,
        },
        dataType: "JSON",
        success: function(res) {
          $("#modalEdit [name='content']").val(res.data.content);
        }
      });

    }

    function deleteE(id) {

      $("#modalDelete button[type='submit']").click(function(e) {
        e.preventDefault();
        $.ajax({
          type: "POST",
          url: window.location.href,
          data: {
            method_type: 'delete',
            id: id,
          },
          dataType: "JSON",
          success: function(res) {

            if (res.status) {
              $("#modalAdd .close").click()
              window.location.reload();
            }
          }
        });

      });
    }


    $("#modalAdd button[type='submit']").click(function(e) {
      e.preventDefault();

      content = $("#modalAdd [name='content']").val();
      $.ajax({
        type: "POST",
        url: window.location.href,
        data: {
          method_type: 'add',
          content: content,
        },
        dataType: "JSON",
        success: function(res) {
          setTimeout(function() {
            if (res.status) {
              $("#modalAdd .close").click()
              window.location.reload();
            }
          }, 500)
        }
      });

    });


    $("#modalEdit button[type='submit']").click(function(e) {
      e.preventDefault();

      let content = $('[name="content"]').val();
      $.ajax({
        type: "POST",
        url: window.location.href,
        data: {
          method_type: 'edit',
          id: id_content,
          content: content
        },
        dataType: "JSON",
        success: function(res) {
          if (res.status) {
            window.location.reload();
          }
        }
      });


    });



    $("form#login").submit(function(e) {
      e.preventDefault();

      let username = $('[name="username"]').val();
      let password = $('[name="password"]').val();
      $.ajax({
        type: "POST",
        url: window.location.href,
        data: {
          method_type: 'login',
          username: username,
          password: password,
        },
        dataType: "JSON",
        success: function(res) {

          $('#top').html(
            `<div class="alert alert-primary" role="alert"><strong> ${res.message} </strong></div>`);
          setTimeout(function() {
            if (res.status) {
              $("#login .close").click()
              window.location.reload();
            }
          }, 1000)

        }
      });
    });

    $("#logout").click(function(e) {
      $.ajax({
        type: "POST",
        url: window.location.href,
        data: {
          method_type: 'logout',
        },
        dataType: "JSON",

        success: function(res) {


          if (res.status) {
            window.location.reload();
          }

        }
      });
    });


    // $(document).ready(function() {
    //   $.ajax({
    //     url: "<?= BASE_URL('home/list') ?>",
    //     dataType: "json",
    //     success: function(response) {
    //       let html_contents = "";
    //       for (const e of response) {
    //         html_contents += `<div class="alert alert-primary d-flex justify-content-between" role="alert">
    //         <strong>${e.content}</strong>
    //         <div class="border border-primary p-1 ml-3 rounded"> <span>Create & Update: ${e.create_at}</span>
    //         </div>
    //       </div>`;
    //       }
    //       $("#contents").html(html_contents);
    //     }
    //   });

    // });
  </script>

</body>

</html>