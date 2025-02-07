<x-guest-layout>
    <div class="p-12 justify-items-center text-center">
        <div>
            <h4>এখানে আপনার স্কয়ার সাইজের বা বর্গাকৃতির ছবি আপলোড করুন</h4>
            <br />

            <!-- File input with wire:ignore to prevent Livewire interference -->
            <input type="file" id="upload" accept="image/*" wire:ignore /><br /><br />

            <!-- Canvas container -->
            <div id="canvas-container">
                <canvas
                    id="userCanvas"
                    width="300"
                    height="300"
                    style="width: 300px; height: 300px"
                ></canvas>
                <canvas
                    id="frameCanvas"
                    width="300"
                    height="300"
                    style="width: 300px; height: 300px"
                ></canvas>
            </div>
            <br /><br />

            <!-- Download button -->
            <button id="download">ফ্রেমসহ ছবি ডাউনলোড করুন</button>

            <script>
                document.addEventListener('livewire:load', function () {
                    const upload = document.getElementById("upload");
                    const exportResolution = 1000; // Export size 1000x1000 pixels

                    // Set up canvases
                    const userCanvas = document.getElementById("userCanvas");
                    const frameCanvas = document.getElementById("frameCanvas");
                    userCanvas.width = exportResolution;
                    userCanvas.height = exportResolution;
                    frameCanvas.width = exportResolution;
                    frameCanvas.height = exportResolution;

                    const userCtx = userCanvas.getContext("2d");
                    const frameCtx = frameCanvas.getContext("2d");

                    // Load the frame overlay at 1000x1000 resolution
                    const frameImage = new Image();
                    frameImage.src = "https://bkmalumni.org/public/image/BKM-Reunion-Photo-Frame.png";
                    frameImage.onload = () => {
                        frameCtx.clearRect(0, 0, exportResolution, exportResolution);
                        frameCtx.drawImage(
                            frameImage,
                            0,
                            0,
                            exportResolution,
                            exportResolution
                        );
                    };

                    // Handle image upload
                    upload.addEventListener("change", (event) => {
                        const file = event.target.files[0];
                        if (!file) return;

                        const reader = new FileReader();
                        reader.onload = (e) => {
                            const img = new Image();
                            img.src = e.target.result;
                            img.onload = () => {
                                userCtx.clearRect(0, 0, exportResolution, exportResolution);

                                // Maintain aspect ratio
                                const scale = Math.max(
                                    exportResolution / img.width,
                                    exportResolution / img.height
                                );
                                const scaledWidth = img.width * scale;
                                const scaledHeight = img.height * scale;
                                const x = (exportResolution - scaledWidth) / 2;
                                const y = (exportResolution - scaledHeight) / 2;

                                // Draw the scaled image on the canvas
                                userCtx.drawImage(img, x, y, scaledWidth, scaledHeight);

                                // Redraw frame after the image is uploaded
                                frameCtx.clearRect(0, 0, exportResolution, exportResolution);
                                frameCtx.drawImage(
                                    frameImage,
                                    0,
                                    0,
                                    exportResolution,
                                    exportResolution
                                );
                            };
                        };
                        reader.readAsDataURL(file);
                    });

                    // Handle download
                    document.getElementById("download").addEventListener("click", () => {
                        const combinedCanvas = document.createElement("canvas");
                        combinedCanvas.width = exportResolution;
                        combinedCanvas.height = exportResolution;
                        const ctx = combinedCanvas.getContext("2d");

                        // Merge user image and frame onto the combined canvas
                        ctx.drawImage(userCanvas, 0, 0, exportResolution, exportResolution);
                        ctx.drawImage(frameCanvas, 0, 0, exportResolution, exportResolution);

                        // Download image
                        const link = document.createElement("a");
                        link.href = combinedCanvas.toDataURL("image/png");
                        link.download = "BKM-Reunion-2025-Profile-Photo.png";
                        link.click();
                    });
                });
            </script>
        </div>
    </div>
</x-guest-layout>
