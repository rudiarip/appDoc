<?php

namespace App\Response\Status;


enum CodeStatus: int
{
  case SUCCESS = 200;
  case CREATED = 201;
  case NOT_FOUND = 404;
  case UNPROCESSABLE_CONTENT = 422;
  case BAD_REQUEST = 400;
  case INTERNAL_ERROR = 500;
  case CONFLICT_ERROR = 409;
}
