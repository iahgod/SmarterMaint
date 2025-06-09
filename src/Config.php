<?php
namespace src;

class Config {
    const BASE_DIR = '/smartermaint/public_html';

    const DB_DRIVER = 'mysql';
    const DB_HOST = 'localhost';
    const DB_DATABASE = 'smartermaint';
    CONST DB_USER = 'root';
    const DB_PASS = '';

    const ERROR_CONTROLLER = 'ErrorController';
    const DEFAULT_ACTION = 'index';

     //!EMAIL

    const HOST = '';
    const USER = '';
    const PASSWORD = '';
    const PORT = '';
    const SMTP_SECURE = '';
    const FROM_NAME = 'Framework 2025';
    const FROM_EMAIL = '';
}