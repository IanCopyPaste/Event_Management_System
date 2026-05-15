<style>
@import url('https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,400;0,600;0,700;1,400&display=swap');

/* Reset helper within footer boundaries */
.site-footer {
    box-sizing: border-box;
    font-family: 'Barlow', sans-serif;
    background-color: #ffffff;
    border-top: 1px solid #e5e7eb;
    color: #4b5563;
    padding: 60px 20px 30px 20px;
    margin-top: 60px;
}

.site-footer * {
    box-sizing: border-box;
}

.footer-inner {
    max-width: 1000px;
    margin: 0 auto;
}

/* Multi-column grid layout */
.footer-grid {
    display: grid;
    grid-template-columns: 2fr 1fr 1fr 1.5fr;
    gap: 40px;
    margin-bottom: 40px;
}

@media (max-width: 768px) {
    .footer-grid {
        grid-template-columns: 1fr;
        gap: 30px;
    }
}

.footer-col-title {
    font-size: 16px;
    font-weight: 700;
    color: #111827;
    margin-bottom: 16px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

/* Links & Text adjustments */
.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 10px;
}

.footer-links a {
    font-size: 14px;
    color: #6b7280;
    text-decoration: none;
    transition: color 0.2s ease;
}

.footer-links a:hover {
    color: rgb(0, 100, 214);
}

.footer-text {
    font-size: 14px;
    color: #6b7280;
    line-height: 1.6;
}

.footer-text strong {
    color: #111827;
}

/* Bottom elements bar */
.footer-bottom {
    border-top: 1px solid #f3f4f6;
    padding-top: 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
}

.footer-copyright {
    font-size: 13px;
    color: #9ca3af;
}

/* Action Utilities */
.back-to-top-btn {
    background: none;
    border: none;
    color: #6b7280;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 4px;
    transition: color 0.2s ease;
}

.back-to-top-btn:hover {
    color: #111827;
}

.logout-btn {
    padding: 10px 16px;
    border: none;
    border-radius: 10px;
    background: rgb(0, 100, 214);
    color: white;
    font-weight: 600;
    cursor: pointer;
    transition: 0.2s ease;
}

.logout-btn:hover {
    background: rgb(0, 78, 167);
    transform: translateY(-1px);
}

.logout-btn:active {
    transform: scale(0.97);
}
</style>

<footer class="site-footer">
    <div class="footer-inner">
        
        <div class="footer-grid">
            
            <div>
                <div class="footer-col-title">University Of Kristian Evangelion</div>
                <p class="footer-text" style="margin-bottom: 8px;"><strong>Diliman Access Tutorials & Reviews</strong></p>
                <p class="footer-text">Providing structured evaluation metrics and quality academic oversight systems.</p>
            </div>
            
            <div>
                <div class="footer-col-title">Legal</div>
                <ul class="footer-links">
                    <li><a href="#privacy">Privacy Policy</a></li>
                    <li><a href="#terms">Terms of Use</a></li>
                    <li><a href="#sitemap">Sitemap</a></li>
                    <li><a href="#affiliates">Affiliates</a></li>
                </ul>
            </div>
            
            
            <div>
                <p class="footer-text">
                    <strong>Tel:</strong> (02) 1 234-5678<br>
                    <strong>Alternative:</strong> (02) 123-45678
                </p>
            </div>
            
        </div>
        
        <div class="footer-bottom">
            <div class="footer-copyright">
                &copy; 2026 Event System. University Of Kristian Evangelion, All Rights Reserved.
            </div>
            
            <button class="back-to-top-btn" onclick="window.scrollTo({top: 0, behavior: 'smooth'});">
                ▲ TOP
            </button>
        </div>
        
    </div>
</footer>