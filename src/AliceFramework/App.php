<?php

declare(strict_types=1);

namespace AliceFramework;

use AliceFramework\Commands\CommandList;

class App
{
    /**
     * @var string Dialog name
     */
    private string $name;

    /**
     * @var Request Dialog request
     */
    private Request $request;

    /**
     * @param string $data Request
     * @param string $name Dialog Name
     */
    public function __construct(string $data, string $name = "AliceFramework")
    {
        $this->name = strtolower($name);
        $this->request = new Request($data);
    }

    /**
     * Start processing request data
     *
     * @return false|string
     */
    public function start() : false|string
    {
        if (!$this->request->isValid())
            return Response::error('Wrong request');

        $response = new Response(
            $this->request->getSessionId(),
            $this->request->getMessageId(),
            $this->request->getUserId()
        );

        // Get command text
        $command = $this->request->getCommand();

        // Command includes skill name
        if (str_contains($command, $this->name) || empty($command))
            return $response->success('Hello i am ' . $this->name);

        // Command processing
        try {
            $executor = CommandList::exists($command);

            // Check command executor
            if (is_null($executor))
                return $response->success('I do not understand');

            return $response->success(
                (new $executor($this->request))->run()
            );
        }
        catch (\Exception $e)
        {
            return Response::error('Command error');
        }
    }
}
