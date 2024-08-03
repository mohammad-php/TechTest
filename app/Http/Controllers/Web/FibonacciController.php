<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class FibonacciController extends Controller
{


    /**
     * Basic Recursive Approach
     *
     * The Fibonacci sequence is defined as:
     * F(0)=0
     * F(1)=1
     * F(n)=F(n−1)+F(n−2) for 𝑛 > 1
     *
     * Time Complexity Analysis ::
     * The time complexity of this naive recursive approach is 𝑂(2^n)
     * This is because, for each call to basicFibonacci($n),
     * it makes two recursive calls,
     * leading to an exponential growth in the number of calls
     *
     * @param int $n
     *
     * @return int
     */
    public function basicRecursiveFibonacci(int $n): int
    {
        if ($n <= 0) {
            return 0;
        } elseif ($n === 1) {
            return 1;
        } else {
            return $this->basicRecursiveFibonacci($n - 1) + $this->basicRecursiveFibonacci($n - 2);
        }
    }


    /**
     * Optimized Approach: Memoization
     *
     * Time Complexity:
     * 𝑂(n)
     *
     * Time Complexity Analysis ::
     * With memoization,
     * we only calculate each Fibonacci number once,
     * so the time complexity becomes linear.
     *
     * @param int $n
     *
     * @return int
     */
    public function optimizedMemoizationFibonacci(int $n): int
    {
        if ($n <= 0) {
            return 0;
        } elseif ($n === 1) {
            return 1;
        }

        $fib = [0, 1];
        for ($i = 2; $i <= $n; $i++) {
            $fib[$i] = $fib[$i - 1] + $fib[$i - 2];
        }
        return $fib[$n];
    }
}
