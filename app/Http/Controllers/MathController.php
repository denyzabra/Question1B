<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MathController extends Controller
{
    /**
     * Handle the missing_digit request.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function missing_digit(Request $request)
    {
        // Retrieve the equation from the request
        $equation = $request->input('str');

        // Call the findMissingDigit function to determine the missing digit
        $result = $this->findMissingDigit($equation);

        // Return the result as a JSON response
        return response()->json(['missing_digit' => $result]);
    }

    /**
     * Show the Missing Digit Viewer HTML page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function showMissingDigitViewer()
    {
        // Return the HTML view for the Missing Digit Viewer
        return view('missing_digit_viewer');
    }

    /**
     * Find the missing digit in the given equation.
     *
     * @param  string  $equation
     * @return mixed
     */
    private function findMissingDigit($equation)
    {
        // Use regular expressions to extract numbers and operator from the equation
        preg_match('/(\d+)[^\d]+(\d+)[^\d]+(\d+)\s*([+\-*\/])\s*(\d+)/', $equation, $matches);

        // Extract numbers and operator
        $num1 = intval($matches[1]);
        $num2 = intval($matches[2]);
        $num3 = intval($matches[3]);
        $operator = $matches[4];
        $result = intval($matches[5]);

        // Determine which number contains the missing digit (indicated by 'x')
        if (strpos($equation, 'x') !== false) {
            // Determine the position of 'x' and assign the corresponding number
            $missingDigitNumber = strpos($equation, 'x') === 0 ? $num1 : (strpos($equation, 'x') > strlen("$num1 $operator ") ? $num3 : $num2);
        } else {
            // If 'x' is not found, return an error or handle it as needed
            return 'Error: Missing digit not found.';
        }

        // Calculate the missing digit based on the operator
        switch ($operator) {
            case '+':
                $missingDigit = $result - ($num1 + $num2 + $num3);
                break;
            case '-':
                $missingDigit = $num1 + $num2 - $result;
                break;
            case '*':
                $missingDigit = $result / ($num1 * $num2 * $num3);
                break;
            case '/':
                $missingDigit = $result * ($num1 / $num2 / $num3);
                break;
            default:
                // Handle invalid operator as needed
                return 'Error: Invalid operator.';
        }

        // Return the missing digit
        return $missingDigit;
    }
}
