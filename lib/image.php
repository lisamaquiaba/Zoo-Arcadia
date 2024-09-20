<?php

function handleImageUpload($fileInputName) {
    $imgContent = null;

    if (isset($fileInputName) && $fileInputName['error'] === UPLOAD_ERR_OK) {
        $image = $fileInputName['tmp_name'];
        
        // Vérification de la taille du fichier
        if ($fileInputName['size'] < 1000000) { // Taille maximale 1 Mo
            $fileType = mime_content_type($image);
            
            // Vérification du type de fichier
            if (in_array($fileType, ['image/jpeg', 'image/png', 'image/gif'])) {
                $imgContent = file_get_contents($image);
            } else {
                return 'Format d\'image non supporté (JPEG, PNG, GIF uniquement).';
            }
        } else {
            return 'Le fichier est trop volumineux. Limite de 1 Mo.';
        }
    } else {
        return 'Erreur de téléchargement ou fichier non sélectionné.';
    }

    return $imgContent; 
}


