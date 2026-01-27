<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display the home page.
     */
    public function home()
    {
        return view('home');
    }

    /**
     * Display student information.
     * Input is sanitized to prevent XSS attacks.
     *
     * @param string $name
     * @param string $studentId
     * @return \Illuminate\View\View
     */
    public function sinhvien(string $name = 'Nguyen Tuan Minh', string $studentId = '4003867')
    {
        // Sanitize inputs to prevent XSS
        $name = $this->sanitizeInput($name);
        $studentId = $this->sanitizeInput($studentId);

        // Validate student ID format (should be numeric)
        if (!preg_match('/^[0-9]+$/', $studentId)) {
            abort(400, 'Invalid student ID format');
        }

        return view('sinhvien', compact('name', 'studentId'));
    }

    /**
     * Display a chess board of size n x n.
     * Input is validated and sanitized.
     *
     * @param int $n
     * @return \Illuminate\View\View
     */
    public function banco(int $n)
    {
        // Validate board size (must be between 1 and 20 for practical display)
        $n = max(1, min(20, (int) $n));

        return view('banco', compact('n'));
    }

    /**
     * Sanitize input to prevent XSS attacks.
     *
     * @param string $input
     * @return string
     */
    private function sanitizeInput(string $input): string
    {
        // Remove any HTML tags and encode special characters
        $sanitized = strip_tags($input);
        $sanitized = htmlspecialchars($sanitized, ENT_QUOTES, 'UTF-8');

        return $sanitized;
    }
}
