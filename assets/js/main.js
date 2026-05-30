/**
 * Finolead Solutions - Premium Interactive Scripts
 * Handles sticky nav transitions, stat counter scrolling, Chart.js integrations,
 * and conversational form steps.
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Sticky Navigation Scrolled Class
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    }

    // 2. Animated Counters when in viewport
    const counters = document.querySelectorAll('.counter-value');
    if (counters.length > 0) {
        const runCounter = (el) => {
            const target = parseInt(el.getAttribute('data-target'), 10);
            const duration = 2000; // 2 seconds
            const stepTime = Math.abs(Math.floor(duration / target));
            let current = 0;
            
            // Set scale increments dynamically to prevent performance lag
            const increment = target > 500 ? Math.ceil(target / 100) : 1;

            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    el.textContent = target.toLocaleString() + (el.getAttribute('data-suffix') || '');
                    clearInterval(timer);
                } else {
                    el.textContent = current.toLocaleString() + (el.getAttribute('data-suffix') || '');
                }
            }, Math.max(stepTime, 15));
        };

        // Scroll Observer
        const observerOptions = {
            threshold: 0.5
        };

        const counterObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    runCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        counters.forEach(counter => {
            counterObserver.observe(counter);
        });
    }

    // 3. Render Chart.js Mockup on Index Page
    const chartEl = document.getElementById('dashboardChart');
    if (chartEl && typeof Chart !== 'undefined') {
        const ctx = chartEl.getContext('2d');

        // Create sleek gradients
        const gradientBlue = ctx.createLinearGradient(0, 0, 0, 300);
        gradientBlue.addColorStop(0, 'rgba(37, 99, 235, 0.4)');
        gradientBlue.addColorStop(1, 'rgba(37, 99, 235, 0.0)');

        const gradientTeal = ctx.createLinearGradient(0, 0, 0, 300);
        gradientTeal.addColorStop(0, 'rgba(20, 184, 166, 0.3)');
        gradientTeal.addColorStop(1, 'rgba(20, 184, 166, 0.0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Dec 2025', 'Jan 2026', 'Feb 2026', 'Mar 2026', 'Apr 2026', 'May 2026'],
                datasets: [
                    {
                        label: 'Gross Loan Volume ($M)',
                        data: [12.4, 18.2, 24.8, 38.1, 49.3, 64.7],
                        borderColor: '#2563EB',
                        backgroundColor: gradientBlue,
                        fill: true,
                        tension: 0.4,
                        borderWidth: 3,
                        pointBackgroundColor: '#2563EB',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7
                    },
                    {
                        label: 'Active Borrowers (x100)',
                        data: [4.2, 7.8, 12.1, 19.4, 28.5, 39.2],
                        borderColor: '#14B8A6',
                        backgroundColor: gradientTeal,
                        fill: true,
                        tension: 0.4,
                        borderWidth: 3,
                        pointBackgroundColor: '#14B8A6',
                        pointBorderColor: '#ffffff',
                        pointBorderWidth: 2,
                        pointRadius: 5,
                        pointHoverRadius: 7
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color: '#94A3B8',
                            font: {
                                family: 'Inter',
                                weight: '600'
                            }
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1E293B',
                        titleFont: { family: 'Inter', weight: 'bold' },
                        bodyFont: { family: 'Inter' },
                        padding: 12,
                        cornerRadius: 8
                    }
                },
                scales: {
                    x: {
                        grid: {
                            color: 'rgba(255, 255, 255, 0.05)'
                        },
                        ticks: {
                            color: '#94A3B8',
                            font: {
                                family: 'Inter'
                            }
                        }
                    },
                    y: {
                        grid: {
                            color: 'rgba(255, 255, 255, 0.05)'
                        },
                        ticks: {
                            color: '#94A3B8',
                            font: {
                                family: 'Inter'
                            }
                        }
                    }
                }
            }
        });
    }

    // 4. Client-side Form Validation
    const secureForms = document.querySelectorAll('.needs-validation-secure');
    secureForms.forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });

    // 5. Testimonial Slider Simulation (simple transition if Bootstrap Carousel not used)
    const testimonialCarousel = document.getElementById('testimonialCarousel');
    if (testimonialCarousel && typeof bootstrap !== 'undefined') {
        new bootstrap.Carousel(testimonialCarousel, {
            interval: 5000,
            ride: 'carousel',
            pause: 'hover',
            autoPlay: true,
        });
    }
});
