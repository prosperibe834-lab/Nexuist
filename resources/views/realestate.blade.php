<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/png" href="{{ asset('assets/Frontend/image/NexuistLogo.png.png') }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Nexuist | Professional Trading</title>
    <link rel="stylesheet" href="{{ asset('assets/Frontend/css/realestate.css') }}">
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>


    <div id="fintech-preloader">
        <div class="loader-container">
            <div class="loader-logo">
                <div class="logo-hexagon">
                    <span class="iconify" data-icon="ri:shield-flash-line"></span>
                </div>
                <h2 class="loader-brand-name">Nexuist</h2>
            </div>

            <div class="loader-progress-wrapper">
                <div class="loader-progress-bar" id="load-bar">
                    <div class="shimmer-effect"></div>
                </div>
            </div>

            <div class="loader-status">
                <span class="status-dot"></span>
                <p id="status-text">Initializing encrypted connection...</p>
            </div>
        </div>

        <div class="glow glow-1"></div>
        <div class="glow glow-2"></div>
    </div>
    <!-- Preloader ends here -->

    @include('layouts.frontend-header-sidebar')



        <!-- Main Content -->
        <section class="tokenized-real-estate">
            <div class="section-header">
                <div class="header-text">
                    <h2>Tokenized Real Estate</h2>
                    <p>Invest in premium real estate properties through tokenization.</p>
                </div>
                <button class="btn-my-investments">
                    <i class='bx bx-wallet'></i> My Investments
                </button>
            </div>

            <div class="property-grid">

                <div class="property-card" data-id="1" data-title="Luxury Miami Condo" data-location="Miami, FL - USA"
                    data-apy="12.4" data-price="571.43" data-min="500.00" data-max="240000"
                    data-img="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=600&q=80">
                    <div class="card-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&w=600&q=80"
                            alt="Luxury Miami Condo">
                        <span class="badge badge-hot"><i class='bx bxs-hot'></i> HOT</span>
                        <span class="badge-apy">12.4% APY</span>
                    </div>
                    <div class="card-content">
                        <div class="card-title-row">
                            <h3>Luxury Miami Condo</h3>
                            <span class="total-value">$2,400,000</span>
                        </div>
                        <p class="location"><i class='bx bx-map'></i> Miami, FL - USA</p>
                        <p class="description">A stunning beachfront condo with panoramic ocean views, open-plan living,
                            and smart home tech.</p>
                        <div class="tags">
                            <span><i class='bx bx-bed'></i> 3 Beds</span>
                            <span><i class='bx bx-bath'></i> 2 Baths</span>
                            <span><i class='bx bx-area'></i> 2,100 sqft</span>
                        </div>
                        <div class="progress-container">
                            <div class="progress-bar" style="width: 60%;"></div>
                        </div>
                        <div class="progress-labels">
                            <span>1,680 tokens sold</span>
                            <span>2,320 available</span>
                        </div>
                        <div class="price-info">
                            <div><small>Token Price</small><strong>$571.43</strong></div>
                            <div><small>Min. Investment</small><strong>$500.00</strong></div>
                        </div>
                        <button class="btn-invest btn-trigger-modal">Invest Now</button>
                    </div>
                </div>

                <div class="property-card" data-id="2" data-title="Dubai Marina Villa"
                    data-location="Dubai Marina, Dubai - UAE" data-apy="14.3" data-price="500.00" data-min="500.00"
                    data-max="380000"
                    data-img="https://images.unsplash.com/photo-1512915922686-57c11dde9b6b?auto=format&fit=crop&w=600&q=80">
                    <div class="card-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1512915922686-57c11dde9b6b?auto=format&fit=crop&w=600&q=80"
                            alt="Dubai Marina Villa">
                        <span class="badge badge-top"><i class='bx bxs-star'></i> TOP</span>
                        <span class="badge-apy">14.3% APY</span>
                    </div>
                    <div class="card-content">
                        <div class="card-title-row">
                            <h3>Dubai Marina Villa</h3>
                            <span class="total-value">$3,800,000</span>
                        </div>
                        <p class="location"><i class='bx bx-map'></i> Dubai Marina, Dubai - UAE</p>
                        <p class="description">An ultra-luxury villa in the heart of Dubai Marina. Private pool and
                            direct marina access.</p>
                        <div class="tags">
                            <span><i class='bx bx-bed'></i> 5 Beds</span>
                            <span><i class='bx bx-bath'></i> 6 Baths</span>
                            <span><i class='bx bx-area'></i> 4,800 sqft</span>
                        </div>
                        <div class="progress-container">
                            <div class="progress-bar" style="width: 45%;"></div>
                        </div>
                        <div class="progress-labels">
                            <span>2,100 tokens sold</span>
                            <span>4,289 available</span>
                        </div>
                        <div class="price-info">
                            <div><small>Token Price</small><strong>$500.00</strong></div>
                            <div><small>Min. Investment</small><strong>$500.00</strong></div>
                        </div>
                        <button class="btn-invest btn-trigger-modal">Invest Now</button>
                    </div>
                </div>

                <div class="property-card" data-id="3" data-title="London Office Tower"
                    data-location="Central London - UK" data-apy="9.8" data-price="434.44" data-min="1000.00"
                    data-max="890000"
                    data-img="https://images.unsplash.com/photo-1549517045-bc93de075e53?auto=format&fit=crop&w=600&q=80">
                    <div class="card-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1549517045-bc93de075e53?auto=format&fit=crop&w=600&q=80"
                            alt="London Office">
                        <span class="badge badge-new"><i class='bx bx-plus-circle'></i> NEW</span>
                        <span class="badge-apy">9.8% APY</span>
                    </div>
                    <div class="card-content">
                        <div class="card-title-row">
                            <h3>London Office Tower</h3>
                            <span class="total-value">$8,900,000</span>
                        </div>
                        <p class="location"><i class='bx bx-map'></i> Central London - UK</p>
                        <p class="description">Grade-A commercial tower in central London. Long-term blue-chip corporate
                            tenants.</p>
                        <div class="tags">
                            <span><i class='bx bx-building'></i> Office</span>
                            <span><i class='bx bx-shield-quarter'></i> Tier 1</span>
                        </div>
                        <div class="progress-container">
                            <div class="progress-bar" style="width: 75%;"></div>
                        </div>
                        <div class="progress-labels">
                            <span>15,500 tokens sold</span>
                            <span>8,500 available</span>
                        </div>
                        <div class="price-info">
                            <div><small>Token Price</small><strong>$434.44</strong></div>
                            <div><small>Min. Investment</small><strong>$1,000.00</strong></div>
                        </div>
                        <button class="btn-invest btn-trigger-modal">Invest Now</button>
                    </div>
                </div>

                <div class="property-card" data-id="4" data-title="New York Penthouse"
                    data-location="Manhattan, NY - USA" data-apy="11.6" data-price="500.00" data-min="1000.00"
                    data-max="1250000"
                    data-img="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=600&q=80">
                    <div class="card-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?auto=format&fit=crop&w=600&q=80"
                            alt="NY Penthouse">
                        <span class="badge badge-hot"><i class='bx bxs-hot'></i> HOT</span>
                        <span class="badge-apy">11.6% APY</span>
                    </div>
                    <div class="card-content">
                        <div class="card-title-row">
                            <h3>New York Penthouse</h3>
                            <span class="total-value">$12,500,000</span>
                        </div>
                        <p class="location"><i class='bx bx-map'></i> Manhattan, NY - USA</p>
                        <p class="description">Iconic Manhattan penthouse with 360-degree skyline views and wraparound
                            terrace.</p>
                        <div class="tags">
                            <span><i class='bx bx-bed'></i> 4 Beds</span>
                            <span><i class='bx bx-bath'></i> 3 Baths</span>
                        </div>
                        <div class="progress-container">
                            <div class="progress-bar" style="width: 30%;"></div>
                        </div>
                        <div class="progress-labels">
                            <span>5,500 tokens sold</span>
                            <span>15,300 available</span>
                        </div>
                        <div class="price-info">
                            <div><small>Token Price</small><strong>$500.00</strong></div>
                            <div><small>Min. Investment</small><strong>$1,000.00</strong></div>
                        </div>
                        <button class="btn-invest btn-trigger-modal">Invest Now</button>
                    </div>
                </div>

                <div class="property-card" data-id="5" data-title="Paris City Apartment"
                    data-location="7th Arr., Paris - France" data-apy="11.2" data-price="350.00" data-min="350.00"
                    data-max="950000"
                    data-img="https://images.unsplash.com/photo-1499955085172-a104c9463ece?auto=format&fit=crop&w=600&q=80">
                    <div class="card-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1499955085172-a104c9463ece?auto=format&fit=crop&w=600&q=80"
                            alt="Paris Apartment">
                        <span class="badge-apy">11.2% APY</span>
                    </div>
                    <div class="card-content">
                        <div class="card-title-row">
                            <h3>Paris City Apartment</h3>
                            <span class="total-value">$950,000</span>
                        </div>
                        <p class="location"><i class='bx bx-map'></i> 7th Arr., Paris - France</p>
                        <p class="description">Elegant Haussmann-style apartment steps away from the Eiffel Tower with
                            classic French balconies.</p>
                        <div class="tags">
                            <span><i class='bx bx-bed'></i> 2 Beds</span>
                            <span><i class='bx bx-bath'></i> 2 Baths</span>
                        </div>
                        <div class="progress-container">
                            <div class="progress-bar" style="width: 80%;"></div>
                        </div>
                        <div class="progress-labels">
                            <span>780 tokens sold</span>
                            <span>1,340 available</span>
                        </div>
                        <div class="price-info">
                            <div><small>Token Price</small><strong>$350.00</strong></div>
                            <div><small>Min. Investment</small><strong>$350.00</strong></div>
                        </div>
                        <button class="btn-invest btn-trigger-modal">Invest Now</button>
                    </div>
                </div>

                <div class="property-card" data-id="6" data-title="Tokyo Modern Studio"
                    data-location="Shibuya, Tokyo - Japan" data-apy="13.1" data-price="600.00" data-min="600.00"
                    data-max="540000"
                    data-img="https://images.unsplash.com/photo-1503899036084-c55cdd92da26?auto=format&fit=crop&w=600&q=80">
                    <div class="card-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1503899036084-c55cdd92da26?auto=format&fit=crop&w=600&q=80"
                            alt="Tokyo Studio">
                        <span class="badge badge-top"><i class='bx bxs-star'></i> TOP</span>
                        <span class="badge-apy">13.1% APY</span>
                    </div>
                    <div class="card-content">
                        <div class="card-title-row">
                            <h3>Tokyo Modern Studio</h3>
                            <span class="total-value">$540,000</span>
                        </div>
                        <p class="location"><i class='bx bx-map'></i> Shibuya, Tokyo - Japan</p>
                        <p class="description">Sleek, neon-view minimalist high-rise luxury studio apartment located in
                            central Shibuya.</p>
                        <div class="tags">
                            <span><i class='bx bx-bed'></i> 1 Bed</span>
                            <span><i class='bx bx-expand'></i> Studio</span>
                        </div>
                        <div class="progress-container">
                            <div class="progress-bar" style="width: 90%;"></div>
                        </div>
                        <div class="progress-labels">
                            <span>1,200 tokens sold</span>
                            <span>150 available</span>
                        </div>
                        <div class="price-info">
                            <div><small>Token Price</small><strong>$600.00</strong></div>
                            <div><small>Min. Investment</small><strong>$600.00</strong></div>
                        </div>
                        <button class="btn-invest btn-trigger-modal">Invest Now</button>
                    </div>
                </div>

                <div class="property-card" data-id="7" data-title="Sydney Harbour Villa"
                    data-location="Sydney - Australia" data-apy="10.5" data-price="450.00" data-min="900.00"
                    data-max="4100000"
                    data-img="https://images.unsplash.com/photo-1580587771525-78b9dba3b914?auto=format&fit=crop&w=600&q=80">
                    <div class="card-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1580587771525-78b9dba3b914?auto=format&fit=crop&w=600&q=80"
                            alt="Sydney Villa">
                        <span class="badge-apy">10.5% APY</span>
                    </div>
                    <div class="card-content">
                        <div class="card-title-row">
                            <h3>Sydney Harbour Villa</h3>
                            <span class="total-value">$4,100,000</span>
                        </div>
                        <p class="location"><i class='bx bx-map'></i> Sydney - Australia</p>
                        <p class="description">Breathtaking architectural masterpiece overlooking the iconic Sydney
                            Opera House and Harbour.</p>
                        <div class="tags">
                            <span><i class='bx bx-bed'></i> 4 Beds</span>
                            <span><i class='bx bx-water'></i> Waterfront</span>
                        </div>
                        <div class="progress-container">
                            <div class="progress-bar" style="width: 55%;"></div>
                        </div>
                        <div class="progress-labels">
                            <span>4,500 tokens sold</span>
                            <span>3,600 available</span>
                        </div>
                        <div class="price-info">
                            <div><small>Token Price</small><strong>$450.00</strong></div>
                            <div><small>Min. Investment</small><strong>$900.00</strong></div>
                        </div>
                        <button class="btn-invest btn-trigger-modal">Invest Now</button>
                    </div>
                </div>

                <div class="property-card" data-id="8" data-title="Bali Eco-Luxury Resort"
                    data-location="Ubud, Bali - Indonesia" data-apy="15.2" data-price="250.00" data-min="250.00"
                    data-max="110000"
                    data-img="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=600&q=80">
                    <div class="card-image-wrapper">
                        <span class="badge badge-new"><i class='bx bx-plus-circle'></i> NEW</span>
                        <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?auto=format&fit=crop&w=600&q=80"
                            alt="Bali Resort">
                        <span class="badge-apy">15.2% APY</span>
                    </div>
                    <div class="card-content">
                        <div class="card-title-row">
                            <h3>Bali Eco-Luxury Resort</h3>
                            <span class="total-value">$1,100,000</span>
                        </div>
                        <p class="location"><i class='bx bx-map'></i> Ubud, Bali - Indonesia</p>
                        <p class="description">Tropical paradise villa featuring private infinity pools integrated
                            seamlessly into the green jungle canopy.</p>
                        <div class="tags">
                            <span><i class='bx bx-sun'></i> Exotic</span>
                            <span><i class='bx bx-swim'></i> Pool</span>
                        </div>
                        <div class="progress-container">
                            <div class="progress-bar" style="width: 88%;"></div>
                        </div>
                        <div class="progress-labels">
                            <span>3,800 tokens sold</span>
                            <span>500 available</span>
                        </div>
                        <div class="price-info">
                            <div><small>Token Price</small><strong>$250.00</strong></div>
                            <div><small>Min. Investment</small><strong>$250.00</strong></div>
                        </div>
                        <button class="btn-invest btn-trigger-modal">Invest Now</button>
                    </div>
                </div>

                <div class="property-card" data-id="9" data-title="Copenhagen Design Loft" data-location="Nyhavn, Copenhagen - DK" data-apy="10.8" data-price="410.00" data-min="820.00" data-max="950000" data-img="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=600&q=80">
      <div class="card-image-wrapper">
        <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=600&q=80') }}" alt="Copenhagen Loft">
        <span class="badge badge-top"><i class='bx bxs-star'></i> TOP</span>
        <span class="badge-apy">10.8% APY</span>
      </div>
      <div class="card-content">
        <div class="card-title-row">
          <h3>Copenhagen Design Loft</h3>
          <span class="total-value">$9,500,000</span>
        </div>
        <p class="location"><i class='bx bx-map'></i> Nyhavn, Copenhagen - DK</p>
        <p class="description">A masterpiece of functional Danish design and Scandinavian modernism overlooking the harbor.</p>
        <div class="tags">
          <span><i class='bx bx-bed'></i> 3 Beds</span>
          <span><i class='bx bx-paint-roll'></i> Design</span>
        </div>
        <div class="progress-container">
          <div class="progress-bar" style="width: 25%;"></div>
        </div>
        <div class="progress-labels">
          <span>5,700 tokens sold</span>
          <span>17,400 available</span>
        </div>
        <div class="price-info">
          <div><small>Token Price</small><strong>$410.00</strong></div>
          <div><small>Min. Investment</small><strong>$820.00</strong></div>
        </div>
        <button class="btn-invest btn-trigger-modal">Invest Now</button>
      </div>
    </div>

            </div>
        </section>

        <div class="investment-modal-overlay" id="investmentModal">
            <div class="modal-card">
                <button class="modal-close-btn" id="closeModalBtn"><i class='bx bx-x'></i></button>

                <div class="modal-header-info">
                    <h3 id="modalPropertyTitle">Invest in Luxury Property</h3>
                    <p id="modalPropertyMeta">Location • 0.0% APY</p>
                </div>

                <div class="balance-strip">
                    <span>Your Balance</span>
                    <strong id="modalBalanceValue">${{ number_format(Auth::user()->balance, 2) }}</strong>
                </div>

                <div class="investment-input-group">
                    <label for="investAmountInput">Investment Amount</label>
                    <div class="input-wrapper">
                        <span class="currency-symbol">$</span>
                        <input type="number" id="investAmountInput" value="500">
                    </div>
                    <small class="limit-label" id="modalLimitLabel">Min: $500.00 • Max: $240,000.00</small>
                </div>

                <div class="preset-chips" id="presetChipsContainer">
                </div>

                <div class="calculation-summary">
                    <div class="summary-row">
                        <span>Tokens you receive</span>
                        <strong id="calcTokens" class="highlight-blue">0 tokens</strong>
                    </div>
                    <div class="summary-row">
                        <span>Duration</span>
                        <span>365 Days</span>
                    </div>
                    <div class="summary-row">
                        <span>ROI Interval</span>
                        <span>Daily</span>
                    </div>
                </div>

                <button class="btn-confirm-investment" id="confirmInvestmentBtn">Confirm Investment</button>
            </div>
        </div>

    </div>

    <script src="{{ asset('assets/Frontend/js/realestate.js') }}"></script>
</body>

</html>


