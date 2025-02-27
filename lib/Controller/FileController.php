<?php

namespace OCA\SimpleUnzipper\Controller;

use OCP\AppFramework\Http\JSONResponse;
use OCP\AppFramework\Controller;
use OCP\Files\IRootFolder;
use OCA\SimpleUnzipper\Service\UnzipService;

class FileController extends Controller {
    private $rootFolder;
    private $userId;
    private $unzipService;

    public function __construct($AppName, IRootFolder $rootFolder, $UserId, UnzipService $unzipService) {
        parent::__construct($AppName);
        $this->rootFolder = $rootFolder;
        $this->userId = $UserId;
        $this->unzipService = $unzipService;
    }

    /**
     * @NoCSRFRequired
     */
    public function unzip($fileId) {
        try {
            $result = $this->unzipService->unzipFile($fileId, $this->userId);
            return new JSONResponse(['success' => $result]);
        } catch (\Exception $e) {
            return new JSONResponse(['success' => false, 'message' => $e->getMessage()], 400);
        }
    }
}
