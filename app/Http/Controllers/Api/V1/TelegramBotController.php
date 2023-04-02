<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Telegram\Bot\Api;

class TelegramBotController extends Controller
{
	protected $telegram;

    public function __construct()
    {
        // dd(456);
    }
	
	/**
     * @OA\Post(
     *      path="/subscribe/messages",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     *      @OA\PathItem (
     *      ),
	 *     @OA\RequestBody(
	 *         @OA\MediaType(
	 *             mediaType="application/json",
	 *             @OA\Schema(
	 *                 @OA\Property(
	 *                     property="token",
	 *                     type="string"
	 *                 ),
	 *                 @OA\Property(
	 *                     property="chat_id",
	 *                     type="string"
	 *                 ),
	 *                 @OA\Property(
	 *                     property="message",
	 *                     type="string"
	 *                 ),
	 *                 example={"token": "a3fb6", "chat_id": "123", "message": "Hi i am a message"}
	 *             )
	 *         )
	 *     ),

	 * )
	 */
	
	public function subscribeMessage(Request $request) {
		$telegram = new Api($request->token);
		$response = $telegram->sendMessage([
			'chat_id' => $request->chat_id,
			'text' => $request->message
		]);
		
		$messageId = $response->getMessageId();
		return response()->json($messageId, 200);
	}

	/**
     * @OA\Post(
     *      path="/set/webhook",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     *     @OA\PathItem (
     *     ),
	 *     @OA\RequestBody(
	 *         @OA\MediaType(
	 *             mediaType="application/json",
	 *             @OA\Schema(
	 *                 @OA\Property(
	 *                     property="token",
	 *                     type="string"
	 *                 ),
	 *                 @OA\Property(
	 *                     property="webhook",
	 *                     type="string"
	 *                 ),
	 *                 example={"token": "a3fb6", "webhook": "getData"}
	 *             )
	 *         )
	 *     ),
     * )
     */
	public function setWebHook(Request $request) {
		$telegram = new Api($request->token);
		$response = $telegram->setWebhook([
			'url' => 'https://example.com/'.$request->token.'/'.$request->webhook,
			'certificate' => '/path/to/public_key_certificate.pub'
		]);
		
		return response()->json($response, 200);
	}
	/**
     * @OA\Get(
     *      path="/get/updates",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *      ),
     *     @OA\PathItem (
     *     ),
     * )
     */
	public function getWebHookUpdates(Request $request) {
		$telegram = new Api($request->token);
		$response = $telegram->getUpdates();
		return response()->json($response, 200);
	}
}
