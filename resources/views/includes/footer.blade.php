<div class="footer">
    <div class="footer-item">
        <a href="/notification" class="{{ request()->is('notification') ? 'active' : '' }}" style="text-decoration: none;">
            <div class="icon_footer">
                <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false"
                    aria-hidden="true" viewBox="0 0 24 24" data-testid="RedeemOutlinedIcon">
                    <path
                        d="M20 6h-2.18c.11-.31.18-.65.18-1 0-1.66-1.34-3-3-3-1.05 0-1.96.54-2.5 1.35l-.5.67-.5-.68C10.96 2.54 10.05 2 9 2 7.34 2 6 3.34 6 5c0 .35.07.69.18 1H4c-1.11 0-1.99.89-1.99 2L2 19c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V8c0-1.11-.89-2-2-2zm-5-2c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zM9 4c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm11 15H4v-2h16v2zm0-5H4V8h5.08L7 10.83 8.62 12 11 8.76l1-1.36 1 1.36L15.38 12 17 10.83 14.92 8H20v6z">
                    </path>
                </svg>
            </div>
            <div class="title_footer">Khuyến mãi</div>
        </a>
    </div>
    <div class="footer-item">
        <a href="/recharge" class="{{ request()->is('recharge') ? 'active' : '' }}" style="text-decoration: none;">
            <div class="icon_footer">
                <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false"
                    aria-hidden="true" viewBox="0 0 24 24" data-testid="AddBusinessOutlinedIcon">
                    <path
                        d="M2 4h15v2H2zm13 13h2v-3h1v-2l-1-5H2l-1 5v2h1v6h9v-6h4v3zm-6 1H4v-4h5v4zm-5.96-6 .6-3h11.72l.6 3H3.04z">
                    </path>
                    <path d="M23 18h-3v-3h-2v3h-3v2h3v3h2v-3h3z"></path>
                </svg>
            </div>
            <div class="title_footer">Nạp tiền</div>
        </a>
    </div>
    <div class="footer-item">
        <a href="/" class="{{ request()->is('/') ? 'active' : '' }}" style="text-decoration: none;">
            <div class="icon_footer {{ request()->is('/') ? 'active' : '' }}">
                <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false"
                    aria-hidden="true" viewBox="0 0 24 24" data-testid="HomeOutlinedIcon">
                    <path d="m12 5.69 5 4.5V18h-2v-6H9v6H7v-7.81l5-4.5M12 3 2 12h3v8h6v-6h2v6h6v-8h3L12 3z"></path>
                </svg>
            </div>
            <div class="footer-center-bg"></div>
            <div class="title_footer">Trang chủ</div>
        </a>
    </div>
    <div class="footer-item">
        <a href="/profile" class="{{ request()->is('profile') ? 'active' : '' }}" style="text-decoration: none;">
            <div class="icon_footer {{ request()->is('profile') ? 'active' : '' }}">
                <svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv" focusable="false"
                    aria-hidden="true" viewBox="0 0 24 24" data-testid="AccountCircleOutlinedIcon">
                    <path
                        d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zM7.35 18.5C8.66 17.56 10.26 17 12 17s3.34.56 4.65 1.5c-1.31.94-2.91 1.5-4.65 1.5s-3.34-.56-4.65-1.5zm10.79-1.38C16.45 15.8 14.32 15 12 15s-4.45.8-6.14 2.12C4.7 15.73 4 13.95 4 12c0-4.42 3.58-8 8-8s8 3.58 8 8c0 1.95-.7 3.73-1.86 5.12z">
                    </path>
                    <path
                        d="M12 6c-1.93 0-3.5 1.57-3.5 3.5S10.07 13 12 13s3.5-1.57 3.5-3.5S13.93 6 12 6zm0 5c-.83 0-1.5-.67-1.5-1.5S11.17 8 12 8s1.5.67 1.5 1.5S12.83 11 12 11z">
                    </path>
                </svg>
            </div>
            <div class="title_footer">Cá nhân</div>
        </a>
    </div>
    <div class="footer-item">
        <a href="/cskh"  style="text-decoration: none;">
            <div class="icon_footer"><svg class="MuiSvgIcon-root MuiSvgIcon-fontSizeMedium css-vubbuv"
                    focusable="false" aria-hidden="true" viewBox="0 0 24 24" data-testid="HeadsetMicOutlinedIcon">
                    <path
                        d="M19 14v4h-2v-4h2M7 14v4H6c-.55 0-1-.45-1-1v-3h2m5-13c-4.97 0-9 4.03-9 9v7c0 1.66 1.34 3 3 3h3v-8H5v-2c0-3.87 3.13-7 7-7s7 3.13 7 7v2h-4v8h4v1h-7v2h6c1.66 0 3-1.34 3-3V10c0-4.97-4.03-9-9-9z">
                    </path>
                </svg>
            </div>
            <div class="title_footer">CSKH</div>
        </a>
    </div>
</div>