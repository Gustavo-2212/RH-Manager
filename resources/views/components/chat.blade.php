<section style="background-color: #EEEEEE;">
  <div class="container py-5">

    <div class="row">
      <div class="col-md-12">

        <div class="card" id="chat3" style="border-radius: 15px;">
          <div class="card-body">

            <div class="row w-100">

              <div class="col-12">

                <div class="pt-3 pe-3" style="position: relative; height: 400px; overflow-y: auto;" id="chat-messages">
                    {{-- Mensagen aparecerão aqui --}}
                </div>



                <div class="text-muted d-flex justify-content-start align-items-center pe-3 pt-3 mt-2">
                  <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp"
                    alt="avatar 3" style="width: 40px; height: 100%;">
                    <form method="POST" action="{{ route("chat.send") }}" class="w-100" id="chat-form">
                        @csrf
                        <input type="hidden" name="target_id" id="target_id" value="">
                        <input type="text" name="message" class="form-control form-control-lg" id="exampleFormControlInput2"
                            placeholder="Digite sua mensagem...">

                        <div class="d-flex justify-content-end align-items-center">
                            <a class="ms-1 text-muted" href="#"><i class="fas fa-paperclip"></i></a>
                            <a class="ms-3 text-muted" href="#"><i class="fas fa-smile"></i></a>
                            <button class="btn btn-outline-dark p-2 m-2" type="submit"><i class="fas fa-paper-plane"></i></button>
                        </div>
                    </form>
                </div>

              </div>
            </div>

          </div>
        </div>

      </div>
    </div>

  </div>
</section>
