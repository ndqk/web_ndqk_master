@extends('admin.layout.master')

@section('titleHeader', 'Create Mail')
@section('nameRoute', 'Mail / Create')

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        @include('admin.partials.mailMenu')
        <div class="col-md-9">
          <div class="card card-primary card-outline">
            <div class="card-header">
              <h3 class="card-title">Compose New Message</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="form-group">
                <input class="form-control" placeholder="To:">
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="Subject:">
              </div>
              <div class="form-group">
                  <textarea id="compose-textarea" class="form-control" style="height: 300px">
                    <h1><u>Heading Of Message</u></h1>
                    <h4>Subheading</h4>
                    <p>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain
                      was born and I will give you a complete account of the system, and expound the actual teachings
                      of the great explorer of the truth, the master-builder of human happiness. No one rejects,
                      dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know
                      how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again
                      is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain,
                      but because occasionally circumstances occur in which toil and pain can procure him some great
                      pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise,
                      except to obtain some advantage from it? But who has any right to find fault with a man who
                      chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that
                      produces no resultant pleasure? On the other hand, we denounce with righteous indignation and
                      dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so
                      blinded by desire, that they cannot foresee</p>
                    <ul>
                      <li>List item one</li>
                      <li>List item two</li>
                      <li>List item three</li>
                      <li>List item four</li>
                    </ul>
                    <p>Thank you,</p>
                    <p>John Doe</p>
                  </textarea>
              </div>
              <div class="form-group">
                <div class="btn btn-default btn-file">
                  <i class="fas fa-paperclip"></i> Attachment
                  <input type="file" name="attachment">
                </div>
                <p class="help-block">Max. 32MB</p>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <div class="float-right">
                <button type="button" class="btn btn-default"><i class="fas fa-pencil-alt"></i> Draft</button>
                <button type="submit" class="btn btn-primary"><i class="far fa-envelope"></i> Send</button>
              </div>
              <button type="reset" class="btn btn-default"><i class="fas fa-times"></i> Discard</button>
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection

@push('script')
<script>
    $(function () {
      //Enable check and uncheck all functionality
      $('.checkbox-toggle').click(function () {
        var clicks = $(this).data('clicks')
        if (clicks) {
          //Uncheck all checkboxes
          $('.mailbox-messages input[type=\'checkbox\']').prop('checked', false)
          $('.checkbox-toggle .far.fa-check-square').removeClass('fa-check-square').addClass('fa-square')
        } else {
          //Check all checkboxes
          $('.mailbox-messages input[type=\'checkbox\']').prop('checked', true)
          $('.checkbox-toggle .far.fa-square').removeClass('fa-square').addClass('fa-check-square')
        }
        $(this).data('clicks', !clicks)
      })
  
      //Handle starring for glyphicon and font awesome
      $('.mailbox-star').click(function (e) {
        e.preventDefault()
        //detect type
        var $this = $(this).find('a > i')
        var glyph = $this.hasClass('glyphicon')
        var fa    = $this.hasClass('fa')
  
        //Switch states
        if (glyph) {
          $this.toggleClass('glyphicon-star')
          $this.toggleClass('glyphicon-star-empty')
        }
  
        if (fa) {
          $this.toggleClass('fa-star')
          $this.toggleClass('fa-star-o')
        }
      })
    })
  </script>
@endpush