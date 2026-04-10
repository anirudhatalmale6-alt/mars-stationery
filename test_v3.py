from playwright.sync_api import sync_playwright
import time

OUT = "/var/lib/freelancer/projects/40289218/test_output"

with sync_playwright() as p:
    browser = p.chromium.launch(headless=True)
    page = browser.new_page(viewport={"width": 1280, "height": 720})
    
    page.goto("http://localhost:8096/", wait_until="domcontentloaded", timeout=30000)
    time.sleep(5)  # Wait for all CSS/JS to load
    
    height = page.evaluate("document.body.scrollHeight")
    print(f"Page height: {height}")
    
    for i in range(10):
        page.evaluate(f"window.scrollTo(0, {i * 720})")
        time.sleep(0.5)
        page.screenshot(path=f"{OUT}/v3_home_{i}.png")
    
    # Check for errors
    errors = page.evaluate("window.__pageErrors || []")
    if errors:
        print(f"JS errors: {errors}")
    
    # Product page
    page.goto("http://localhost:8096/products", wait_until="domcontentloaded", timeout=15000)
    time.sleep(2)
    page.screenshot(path=f"{OUT}/v3_products.png")
    
    # Contact
    page.goto("http://localhost:8096/contact", wait_until="domcontentloaded", timeout=15000)
    time.sleep(1)
    page.screenshot(path=f"{OUT}/v3_contact.png")
    
    browser.close()
    print("Done")
