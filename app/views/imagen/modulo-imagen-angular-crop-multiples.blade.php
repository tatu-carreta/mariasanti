<style>
    .my-drop-zone { border: dotted 3px lightgray; }
    .nv-file-over { border: dotted 3px red; } /* Default class applied to drop zones on over */
    .another-file-over-class { border: dotted 3px green; }

    html, body { height: 100%; }
</style>
<style>
    .cropArea {
        background: #E4E4E4;
        margin: auto;
        overflow: hidden;
    }
    .cropArea.big {
        width:800px;
        height:600px;
    }
    .cropArea.medium {
        width:500px;
        height:350px;
    }
    .cropArea.small {
        width:300px;
        height:200px;
    }
</style>

        <input id="fileInput" type="file" nv-file-select="" uploader="uploader" name="imagen_original"/>
        <!--<input type="hidden" name="imagen_portada_crop" value="<% imagen_portada %>">-->

        <div class="cropArea" ng-class="{'big':size == 'big', 'medium':size == 'medium', 'small':size == 'small'}">
            <img-crop image="image"
                      result-image="croppedImage"
                      change-on-fly="changeOnFly"
                      area-type="<% type %>"
                      area-min-size="selMinSize"
                      result-image-format="<% resImgFormat %>"
                      result-image-quality="resImgQuality"
                      result-image-size="resImgSize"
                      on-change="onChange($dataURI)"
                      on-load-begin="onLoadBegin()"
                      on-load-done="onLoadDone()"
                      on-load-error="onLoadError()"
                      ></img-crop>
            <!-- crop area if uploaded image
            <img-crop ng-show="image" image="image" result-image="croppedImage" area-type="square" result-image-size="280"></img-crop>-->
            <input type="hidden" ng-model="foto">
            <!--aspect-ratio="aspectRatio"-->
        </div>
        <div style="text-align:center">
            <h3>Result</h3>
            <div>
                <img ng-src="<% croppedImage %>" />
            </div>
        </div>
        <input class="form-control" type="text" id="epigrafe" name="epigrafe_imagen_portada" placeholder="Ingrese una descripción de la foto">
        <div style="margin-bottom: 40px;margin-top: 20px;">
            <table class="table">
                <thead>
                    <tr>
                        <th width="50%">Name</th>
                        <th ng-show="uploader.isHTML5">Size</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="item in uploader.queue">
                        <td><strong><% item.file.name %></strong></td>
                        <td ng-show="uploader.isHTML5" nowrap><% item.file.size / 1024 / 1024|number:2 %> MB</td>
                    </tr>
                </tbody>
            </table>

            <div>
                <div>
                    Queue progress:
                    <div class="progress" style="">
                        <div class="progress-bar" role="progressbar" ng-style="{ 'width': uploader.progress + '%' }"></div>
                    </div>
                </div>
                <button type="button" class="btn btn-success btn-s" ng-click="uploader.uploadAll()" ng-disabled="!uploader.getNotUploadedItems().length">
                    <span class="glyphicon glyphicon-upload"></span> Upload all
                </button>
                <button type="button" class="btn btn-danger btn-s" ng-click="removerImagen()" ng-disabled="!uploader.queue.length">
                    <span class="glyphicon glyphicon-trash"></span> Remove all
                </button>
            </div>

</div>