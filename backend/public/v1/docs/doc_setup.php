<?php
/**
 * @OA\Info(
 *     title="API",
 *     description="SkillSwap API",
 *     version="1.0",
 *     @OA\Contact(
 *         email="fatihtheg123@protonmail.com",
 *         name="Web Programming"
 *     )
 * )
 * 
 * @OA\Server(
 *     url="http://localhost/SkillSwap/backend",
 *     description="Local API server"
 * )
 * 
 * @OA\Server(
 *     url="prodserver",
 *     description="Production API server"
 * )
 * 
 * @OA\SecurityScheme(
 *     securityScheme="ApiKey",
 *     type="apiKey",
 *     in="header",
 *     name="Authentication"
 * )
 */