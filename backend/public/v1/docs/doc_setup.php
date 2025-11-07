<?php

/**
 * @OA\Info(
 *   title="API",
 *   description="SkillSwap API",
 *   version="1.0",
 *   @OA\Contact(
 *     email="fatihtheg123@protonmail.com",
 *     name="Web Programming"
 *   )
 * ),
 * @OA\Server(
 *     url=LOCALSERVER,
 *     description="API server"
 * ),
 * @OA\Server(
 *     url=PRODSERVER,
 *     description="API server"
 * ),
 * @OA\SecurityScheme(
 *     securityScheme="ApiKey",
 *     type="apiKey",
 *     in="header",
 *     name="Authentication"
 * )
 */
