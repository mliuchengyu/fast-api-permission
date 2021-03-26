<?php
/**
 * @OA\OpenApi(
 *     @OA\Info(
 *         version="1.0.0",
 *         title="newbee api doc",
 *         description="or this sample, you can use the api key `special-key` to test the authorization filters.",
 *         @OA\Contact(
 *             email="mliuchengyu@live.cn"
 *         )
 *     ),
 *     @OA\Server(
 *         description="本地接口",
 *         url="http://127.0.0.1:8000"
 *     ),
 *     @OA\Server(
 *         description="测试接口",
 *         url="https://fast-api.dnat.link"
 *     )
 * )
 */
/**
 * @OA\SecurityScheme(
 *     type="oauth2",
 *     description="Use a global client_id / client_secret and your username / password combo to obtain a token",
 *     name="Authorization",
 *     in="header",
 *     scheme="http",
 *     securityScheme="授权登陆",
 *     @OA\Flow(
 *         flow="password",
 *         tokenUrl="/api/apidoc",
 *         scopes={}
 *     )
 * )
 */
