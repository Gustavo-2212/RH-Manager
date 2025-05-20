<div class="col-3">
        <div class="d-flex justify-content-center align-items-center">
            <div class="image position-relative">
            @if ($image)
                <img src="{{ url("storage/{$image}") }}"
                    class="object-fit-cover rounded-circle border border-3 border-white"
                    style="width: 50px; height: 50px;"
                    id="image"
                    alt="profile image">
            @else
                <img src="{{ url("storage/users/default.png") }}"
                    class="object-fit-cover rounded-circle border border-3 border-white"
                    style="width: 50px; height: 50px;"
                    id="image"
                    alt="profile image">
            @endif

            <label for="file_image_path"
                    class="position-relative bottom-0 end-0 translate-middle d-flex justify-content-center align-items-center rounded-circle border border-2 border-white"
                    style="width: 40px; height: 40px; background-color: #0d6efd; cursor: pointer;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="white" class="bi bi-camera" viewBox="0 0 16 16">
                        <path d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4z"/>
                        <path d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5m0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7M3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/>
                    </svg>
            </label>

            <input type="file"
                    name="file_image_path"
                    id="file_image_path"
                    class="d-none"
                    accept="image/jpeg,image/png,image/jpg">
            </div>
        </div>     
   
    <script>
        const img_elem = document.querySelector("#image");
        const file_img = document.querySelector("#file_image_path");

        file_img.onchange = function () {
            img_elem.src = URL.createObjectURL(file_img.files[0]);
        }
    </script>

</div>


