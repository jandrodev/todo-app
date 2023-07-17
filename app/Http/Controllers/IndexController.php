<?php

namespace App\Http\Controllers;

use App\Handlers\ViewHandler;
use Inertia\{Inertia, Response};

class IndexController extends Controller
{
    /**
     * @param ViewHandler $viewHandler
     */
    public function __construct(public ViewHandler $viewHandler)
    {
        //
    }

    /**
     * @return Response
     */
    public function indexView(): Response
    {
        return Inertia::render('Index', [
            'categories' => $this->viewHandler->categoriesList(),
            'tasksNonCompleted' => $this->viewHandler->tasksList(false),
            'tasksCompleted' => $this->viewHandler->tasksList(),
        ]);
    }
}
