import Dropzone from "dropzone";


Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Sube aqui tu imagen',
    acceptedFiles: ".png,.jpg,.jpeg",
    addRemoveLinks: true,
    dictRemoveFile: 'Borrar Archivo',
    maxFilesize: 1,
    uploadMultiple: true,
    thumbnailWidth: 200
});
