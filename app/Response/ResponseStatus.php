<?php

namespace App\Response;

use App\Response\Status\CodeStatus;
use Illuminate\Http\JsonResponse;


class ResponseStatus
{
  public static function successMessage(string $message): JsonResponse
  {
    return response()->json(
      [
        "status" => "success",
        "message" => $message,
      ],
      CodeStatus::SUCCESS->value
    );
  }
  public static function successCreated(string $message): JsonResponse
  {
    return response()->json([
      "status" => "success",
      "message" => $message,

    ], CodeStatus::CREATED->value);
  }
  public static function successResponse(array | object $data): JsonResponse
  {
    return response()->json([
      "status" => "success",
      "data" => $data,

    ], CodeStatus::SUCCESS->value);
  }

  public static function internalError(string $message): JsonResponse
  {
    return response()->json([
      "status" => "fail",
      "message" => $message,
    ], CodeStatus::INTERNAL_ERROR->value);
  }
  public static function notFound(string $message): JsonResponse
  {
    return response()->json([
      "status" => "fail",
      "message" => $message,
    ], CodeStatus::NOT_FOUND->value);
  }
  public static function unprocessContent(string $message, array | object $errors): JsonResponse
  {
    return response()->json([
      "status" => "fail",
      "message" => $message,
      "errors" => $errors,
    ], CodeStatus::UNPROCESSABLE_CONTENT->value);
  }
  public static function badRequest(string $message): JsonResponse
  {
    return response()->json([
      "status" => "fail",
      "message" => $message,
    ], CodeStatus::BAD_REQUEST->value);
  }
}
