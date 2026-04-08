from playwright.sync_api import sync_playwright
import time

OUT = "/var/lib/freelancer/projects/40289218/test_output"

with sync_playwright() as p:
    browser = p.chromium.launch(headless=True)
    page = browser.new_page(viewport={"width": 1280, "height": 720})
    
    page.goto("http://localhost:8096/", wait_until="domcontentloaded", timeout=15000)
    time.sleep(3)
    
    height = page.evaluate("document.body.scrollHeight")
    print(f"Page height: {height}")
    
    for i in range(9):
        page.evaluate(f"window.scrollTo(0, {i * 720})")
        time.sleep(0.5)
        page.screenshot(path=f"{OUT}/new_home_{i}.png")
    
    # Products page
    page.goto("http://localhost:8096/products", wait_until="domcontentloaded", timeout=15000)
    time.sleep(1)
    page.screenshot(path=f"{OUT}/new_products.png")
    
    # Product detail
    page.goto("http://localhost:8096/products/pilot-g2-gel-pen-black", wait_until="domcontentloaded", timeout=15000)
    time.sleep(1)
    page.screenshot(path=f"{OUT}/new_product_detail.png")
    
    # Contact
    page.goto("http://localhost:8096/contact", wait_until="domcontentloaded", timeout=15000)
    time.sleep(1)
    page.screenshot(path=f"{OUT}/new_contact.png")
    
    browser.close()
    print("Done")
