{{ content() }}

<h3>Take Site Photos</h3>

1.  Before wiring - ATS connections <br>
<label for='alvin' class="btn btn-default btn-file">
Upload <input id='alvin' type="file" accept="image/*" capture="camera" onchange='cacheImage(this);' style='display: none'/>
</label>
<button>View Photo</button> <br>
<div id='image-holder' style='display:none;'></div>

2.  Before wiring - Alarm block connections <br>
<input type="file" accept="image/*" capture="camera"/>
<button>View Photo</button> <br>

3.  Before wiring - Generator controller connections <br>
<input type="file" accept="image/*" capture="camera"/>
<button>View Photo</button> <br>

4.  Before wiring - Fuel gauge connections <br>
<input type="file" accept="image/*" capture="camera"/>
<button>View Photo</button> <br>

5.  Front of SiteBoss <br>
<input type="file" accept="image/*" capture="camera"/>
<button>View Photo</button> <br>

6.  Back of SiteBoss after wired <br>
<input type="file" accept="image/*" capture="camera"/> 
<button>View Photo</button> <br>

7.  Power Connection to fuse panel/power bay <br>
<input type="file" accept="image/*" capture="camera"/>
<button>View Photo</button> <br>


<script>
function cacheImage(that)
{
	debugger;
	     //Get count of selected files
     var countFiles = $(that)[0].files.length;

     var imgPath = $(that)[0].value;
     var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
     var image_holder = $("#image-holder");
     image_holder.empty();

     if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
         if (typeof (FileReader) != "undefined") {

             //loop for each file selected for uploaded.
             for (var i = 0; i < countFiles; i++) {

                 var reader = new FileReader();
                 reader.onload = function (e) {
                     $("<img />", {
                         "src": e.target.result,
                             "class": "thumb-image"
                     }).appendTo(image_holder);
                 }

                 image_holder.show();
                 reader.readAsDataURL($(that)[0].files[i]);
             }

         } else {
             alert("This browser does not support FileReader.");
         }
     } else {
         alert("Pls select only images");
     }

}
</script>
