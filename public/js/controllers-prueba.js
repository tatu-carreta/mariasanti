'use strict';


angular


        .module('app', ['angularFileUpload', 'ngImgCrop'], function ($interpolateProvider) {
            $interpolateProvider.startSymbol('<%');
            $interpolateProvider.endSymbol('%>');
        })


        .controller('AppController', ['$scope', 'FileUploader', function ($scope, FileUploader) {
                $scope.size = 'small';
                $scope.type = 'square';
                $scope.image = '';
                $scope.croppedImage = '';
                $scope.resImgFormat = 'image/png';
                $scope.resImgQuality = 1;
                $scope.selMinSize = 100;
                $scope.resImgSize = 280;
                
                $scope.imagenes_seleccionadas = [];
                var imagen = {
                        'imagen_original': '',
                        'src': '',
                        'epigrafe': '',
                        'imagen_portada': ''
                    };

                $scope.removerImagen = function () {
                    uploader.clearQueue();
                    $scope.image = '';
                    $scope.croppedImage = '';
                    angular.element(document.querySelector('#fileInput')).val('');
                };

                $scope.onChange = function ($dataURI) {
                    console.log('onChange fired - ' + $scope.foto._file);
                    
                    var blob = dataURItoBlob($dataURI);
                    $scope.foto._file = blob;
                    console.log('onChange fired - ' + $scope.foto._file.type);
                };
                $scope.onLoadBegin = function () {
                    console.log('onLoadBegin fired');
                };
                $scope.onLoadDone = function () {
                    console.log('onLoadDone fired');
                };
                $scope.onLoadError = function () {
                    console.log('onLoadError fired');
                };
                var handleFileSelect = function (evt) {
                    var file = evt.currentTarget.files[0];
                    console.log(file);
                    imagen.imagen_original = file;
                    var reader = new FileReader();
                    reader.onload = function (evt) {
                        $scope.$apply(function ($scope) {
                            $scope.imageDataURI = evt.target.result;
                        });
                    };
                    reader.readAsDataURL(file);
                };
                angular.element(document.querySelector('#fileInput')).on('change', handleFileSelect);
                $scope.$watch('resImageDataURI', function () {
                    //console.log('Res image', $scope.resImageDataURI);
                });

                var uploader = $scope.uploader = new FileUploader({
                    url: 'http://localhost/mariasanti/public/admin/imagen/crop/upload'
                });

                // FILTERS

                uploader.filters.push({
                    name: 'customFilter',
                    fn: function (item /*{File|FileLikeObject}*/, options) {
                        return this.queue.length < 1;
                    },
                    texto: 'Está intentando cargar una imagen nueva',
                });
                uploader.filters.push({
                    name: 'sizeLimit',
                    fn: function (item /*{File|FileLikeObject}*/, options) {
                        //500kb
                        return item.size < 500000;
                    },
                    texto: 'Excede los 500kb'
                });

                // CALLBACKS

                uploader.onWhenAddingFileFailed = function (item /*{File|FileLikeObject}*/, filter, options) {
                    console.info('onWhenAddingFileFailed', item, filter, options);
                    alert(filter.texto);
                };
                /*
                 uploader.onAfterAddingFile = function (fileItem) {
                 console.info('onAfterAddingFile', fileItem);
                 };
                 */
                uploader.onAfterAddingFile = function (item) {
                    $scope.foto = item;
                    var reader = new FileReader();
                    reader.onload = function (event) {
                        $scope.$apply(function () {
                            $scope.image = event.target.result;
                        });
                    };
                    reader.readAsDataURL(item._file);
                };

                /**
                 * Upload Blob (cropped image) instead of file.
                 * @see
                 *   https://developer.mozilla.org/en-US/docs/Web/API/FormData
                 *   https://github.com/nervgh/angular-file-upload/issues/208
                 */
                uploader.onBeforeUploadItem = function (item) {
                    var blob = dataURItoBlob($scope.croppedImage);
                    item._file = blob;

                };

                /**
                 * Converts data uri to Blob. Necessary for uploading.
                 * @see
                 *   http://stackoverflow.com/questions/4998908/convert-data-uri-to-file-then-append-to-formdata
                 * @param  {String} dataURI
                 * @return {Blob}
                 */
                var dataURItoBlob = function (dataURI) {
                    var binary = atob(dataURI.split(',')[1]);
                    var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];
                    var array = [];
                    for (var i = 0; i < binary.length; i++) {
                        array.push(binary.charCodeAt(i));
                    }
                    return new Blob([new Uint8Array(array)], {type: mimeString});
                };

                uploader.onAfterAddingAll = function (addedFileItems) {
                    console.info('onAfterAddingAll', addedFileItems);
                };
                uploader.onBeforeUploadItem = function (item) {
                    console.info('onBeforeUploadItem', item);
                };
                uploader.onProgressItem = function (fileItem, progress) {
                    console.info('onProgressItem', fileItem, progress);
                };
                uploader.onProgressAll = function (progress) {
                    console.info('onProgressAll', progress);
                };
                uploader.onSuccessItem = function (fileItem, response, status, headers) {
                    console.info('onSuccessItem', fileItem, response, status, headers);
                };
                uploader.onErrorItem = function (fileItem, response, status, headers) {
                    console.info('onErrorItem', fileItem, response, status, headers);
                };
                uploader.onCancelItem = function (fileItem, response, status, headers) {
                    console.info('onCancelItem', fileItem, response, status, headers);
                };
                uploader.onCompleteItem = function (fileItem, response, status, headers) {
                    console.info('onCompleteItem', response);
                    $scope.imagen_portada = response.imagen_path;
                    
                    //imagen.imagen_original = angular.element(document.querySelector('#fileInput')).val();
                    imagen.src = $scope.croppedImage;
                    imagen.epigrafe = angular.element(document.querySelector('#epigrafe')).val();
                    imagen.imagen_portada = $scope.imagen_portada;

                    $scope.imagenes_seleccionadas.push(imagen);
                    
                    console.log(imagen);
                };
                uploader.onCompleteAll = function () {
                    console.info('onCompleteAll');

                };

                console.info('uploader', uploader);
            }]);
