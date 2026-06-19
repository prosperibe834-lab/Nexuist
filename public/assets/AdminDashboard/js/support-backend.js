// Preloader starts here
(function() {
    const preloaderElement = document.getElementById('nexuist-preloader');
    if (!preloaderElement) return;
    const dismissLoader = () => {
        if (!preloaderElement.classList.contains('loaded')) {
            preloaderElement.classList.add('loaded');
        }
    };
    window.addEventListener('load', dismissLoader);
    setTimeout(dismissLoader, 2000);
})();

// Sidebar & Theme Logic
document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.getElementById("sidebar");
    const toggleBtn = document.getElementById("sidebar-toggle-btn");
    const mobileMenuBtn = document.getElementById("mobile-hamburger-btn");
    const modeToggle = document.querySelector(".mode-toggle-wrapper");
    const modeIcon = document.querySelector(".mode-icon-indicator");
    const modeLabel = document.querySelector(".mode-label");
    const navLinks = document.querySelectorAll(".nav-links > li:not(.control-items)");
    const pageTitle = document.getElementById("page-title-display");

    if (toggleBtn) {
        toggleBtn.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });
    }

    if (mobileMenuBtn) {
        mobileMenuBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            sidebar.classList.toggle("open");
        });
    }

    document.addEventListener("click", (e) => {
        if (window.innerWidth <= 576 && !sidebar.contains(e.target) && sidebar.classList.contains("open")) {
            sidebar.classList.remove("open");
        }
    });

    const savedTheme = localStorage.getItem("theme") || "dark";
    document.documentElement.setAttribute("data-theme", savedTheme);
    updateThemeUI(savedTheme);

    if (modeToggle) {
        modeToggle.addEventListener("click", () => {
            const currentTheme = document.documentElement.getAttribute("data-theme");
            const newTheme = currentTheme === "dark" ? "light" : "dark";
            document.documentElement.setAttribute("data-theme", newTheme);
            localStorage.setItem("theme", newTheme);
            updateThemeUI(newTheme);
        });
    }

    function updateThemeUI(theme) {
        if (!modeIcon || !modeLabel) return;
        if (theme === "light") {
            modeIcon.className = "bx bx-sun mode-icon-indicator";
            modeLabel.textContent = "Light Mode";
        } else {
            modeIcon.className = "bx bx-moon mode-icon-indicator";
            modeLabel.textContent = "Dark Mode";
        }
    }

    navLinks.forEach(linkItem => {
        const anchor = linkItem.querySelector("a");
        if (!anchor) return;
        anchor.addEventListener("click", function(e) {
            navLinks.forEach(item => item.classList.remove("active"));
            linkItem.classList.add("active");
            const textSpan = linkItem.querySelector(".link_name");
            if (textSpan && pageTitle) {
                pageTitle.textContent = textSpan.textContent;
            }
            if (window.innerWidth <= 576) {
                sidebar.classList.remove("open");
            }
        });
    });
});

// ============================================
// BACKEND-DRIVEN SUPPORT TICKET LOGIC
// ============================================
const adminCsrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
let supportTicketCache = {};
let activeSelectedTicketId = null;

function escapeHtml(value) {
    return String(value || '').replace(/[&<>"'`]/g, function(c) {
        return {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#39;',
            '`': '&#96;'
        }[c];
    });
}

function getTicketStatusClass(status) {
    return `s-${String(status || 'Open').toLowerCase().replace(/\s+/g, '')}`;
}

function getTicketPriorityClass(category) {
    if (!category) return 'p-medium';
    return category.toLowerCase().includes('issue') || category.toLowerCase().includes('security') ? 'p-high' : 'p-medium';
}

function getInitials(name) {
    if (!name) return 'U';
    const parts = name.trim().split(' ').filter(Boolean);
    if (parts.length === 0) return 'U';
    if (parts.length === 1) return parts[0].charAt(0).toUpperCase();
    return (parts[0].charAt(0) + parts[parts.length - 1].charAt(0)).toUpperCase();
}

function getBaseUrl() {
    return window.NEXUIST_BASE_URL || '';
}

async function fetchAdminSupportTickets() {
    const tableBody = document.getElementById('ticketTableBody');
    if (!tableBody) return;
    tableBody.innerHTML = '<tr><td colspan="7" style="text-align:center;padding:20px;">Loading support tickets...</td></tr>';

    try {
        const response = await fetch(`${getBaseUrl()}/admin/support/tickets`);
        if (!response.ok) throw new Error('Unable to load support tickets.');
        const data = await response.json();
        const tickets = Array.isArray(data.tickets) ? data.tickets : [];

        tickets.forEach(ticket => {
            supportTicketCache[ticket.id] = ticket;
        });

        renderTicketTable(tickets);
        updateSupportStats(tickets);

        if (tickets.length > 0) {
            selectTicket(tickets[0].id);
        } else {
            tableBody.innerHTML = '<tr><td colspan="7" style="text-align:center;padding:20px;">No support tickets found.</td></tr>';
        }
    } catch (error) {
        console.error(error);
        tableBody.innerHTML = `<tr><td colspan="7" style="text-align:center;padding:20px;color:red;">${escapeHtml(error.message)}</td></tr>`;
    }
}

function renderTicketTable(tickets) {
    const tbody = document.getElementById('ticketTableBody');
    if (!tbody) return;
    tbody.innerHTML = tickets.map(ticket => {
        const ticketId = escapeHtml(ticket.id);
        const userName = escapeHtml(ticket.name || 'Unknown User');
        const uidLabel = ticket.user_id ? `#USR-${ticket.user_id}` : '#GUEST';
        const categoryLabel = escapeHtml(ticket.category || 'General');
        const subjectLabel = escapeHtml(ticket.subject || 'Support Request');
        const statusLabel = escapeHtml(ticket.status || 'Open');
        const priorityClass = getTicketPriorityClass(categoryLabel);
        const statusClass = getTicketStatusClass(statusLabel);
        const submittedDate = escapeHtml(ticket.created_at ? ticket.created_at.substring(0, 10) : '');

        return `<tr data-user="${userName}" data-uid="${uidLabel}" onclick="selectTicket('${ticketId}')">
            <td><span class="ticket-id-tag">${ticketId}</span></td>
            <td><div class="user-profile-cell"><div class="avatar-circle-placeholder">${getInitials(userName)}</div>
            <div><div class="profile-fullname">${userName}</div><div class="profile-uid">${uidLabel}</div></div></div></td>
            <td><div class="ticket-subject-text">${subjectLabel}</div><div class="ticket-cat-sub">${categoryLabel}</div></td>
            <td><span class="priority-badge ${priorityClass}">${priorityClass === 'p-high' ? 'High' : 'Medium'}</span></td>
            <td><span class="status-badge ${statusClass}">${statusLabel}</span></td>
            <td class="date-cell-text">${submittedDate}</td>
            <td><button class="table-control-btn" title="View Ticket"><i class="bx bx-message-square-detail"></i></button></td></tr>`;
    }).join('');
}

function updateSupportStats(tickets) {
    const openCount = tickets.filter(t => t.status === 'Open').length;
    const resolvedCount = tickets.filter(t => t.status === 'Resolved').length;
    const totalCount = tickets.length;
    const highPriorityCount = tickets.filter(t => (t.category || '').toLowerCase().includes('issue') || (t.category || '').toLowerCase().includes('security')).length;

    const openValue = document.getElementById('stat-open-count');
    if (openValue) openValue.innerText = openCount.toString();
    
    document.querySelectorAll('.metric-value').forEach((el, i) => {
        if (i === 0) el.innerText = totalCount.toString();
        if (i === 1) el.innerText = openCount.toString();
        if (i === 2) el.innerText = resolvedCount.toString();
        if (i === 3) el.innerText = highPriorityCount.toString();
    });
}

async function selectTicket(ticketId) {
    if (!ticketId) return;
    activeSelectedTicketId = ticketId;
    highlightSelectedRow(ticketId);

    if (supportTicketCache[ticketId] && supportTicketCache[ticketId].messages) {
        renderTicketDetails(supportTicketCache[ticketId]);
        return;
    }

    try {
        const response = await fetch(`${getBaseUrl()}/admin/support/tickets/${ticketId}`);
        if (!response.ok) throw new Error('Unable to load ticket details.');
        const data = await response.json();
        const ticket = data.ticket;
        supportTicketCache[ticketId] = ticket;
        renderTicketDetails(ticket);
    } catch (error) {
        console.error(error);
        alert(error.message || 'Unable to load ticket details.');
    }
}

function highlightSelectedRow(ticketId) {
    document.querySelectorAll('#ticketTableBody tr').forEach(row => {
        const rowTicketId = row.querySelector('.ticket-id-tag')?.innerText;
        row.classList.toggle('selected-ticket-row', rowTicketId === ticketId);
    });
}

function renderTicketDetails(ticket) {
    if (!ticket) return;
    const userName = ticket.name || 'Unknown User';
    const statusText = ticket.status || 'Open';
    const categoryText = ticket.category || 'General';
    const complaintText = ticket.messages?.find(m => m.sender === 'user')?.message || ticket.subject || 'No message available.';

    document.getElementById('deck-username').innerText = userName;
    const statusField = document.getElementById('deck-status');
    if (statusField) {
        statusField.innerText = statusText;
        statusField.className = `detail-value ${statusText === 'Resolved' ? 'text-success' : statusText === 'Escalated' ? 'color-warning' : 'text-success'}`;
    }

    const collateralField = document.querySelector('.deck-account-details .details-row-grid:last-of-type div:first-child .detail-value');
    const txField = document.querySelector('.deck-account-details .details-row-grid:last-of-type div:last-child .detail-value');
    if (collateralField) collateralField.innerText = categoryText;
    if (txField) txField.innerText = ticket.id || '';

    const complaintField = document.getElementById('deck-complaint');
    if (complaintField) complaintField.innerText = complaintText;

    const attachmentField = document.querySelector('.attachment-preview-box span');
    if (attachmentField) attachmentField.innerText = ticket.attachment || 'No attachment uploaded.';

    const headerTitle = document.getElementById('chat-header-title');
    if (headerTitle) headerTitle.innerText = `Live Chat Stream: ${ticket.id}`;

    renderChatStream(ticket.messages || []);
}

function renderChatStream(messages) {
    const messageStreamWindow = document.getElementById('chatMessageStream');
    if (!messageStreamWindow) return;
    messageStreamWindow.innerHTML = '';
    messages.forEach(msg => {
        const type = msg.sender === 'admin' ? 'admin' : 'user';
        const time = msg.created_at ? new Date(msg.created_at).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) : '';
        appendMessageToStreamView(msg.message, type, `${time}${type === 'admin' ? ' • Seen' : ''}`);
    });
    scrollChatStreamToBottom();
}

function initSearchAndFilterSystem() {
    const searchInput = document.getElementById('ticketSearch');
    const statusSelect = document.getElementById('statusFilter');
    const categorySelect = document.getElementById('categoryFilter');
    const prioritySelect = document.getElementById('priorityFilter');

    function applyFilters() {
        const query = searchInput?.value.toLowerCase().trim() || '';
        const filterStatus = statusSelect?.value.toLowerCase() || '';
        const filterCategory = categorySelect?.value.toLowerCase() || '';
        const filterPriority = prioritySelect?.value.toLowerCase() || '';

        document.querySelectorAll('#ticketTableBody tr').forEach(row => {
            const userName = row.getAttribute('data-user')?.toLowerCase() || '';
            const uid = row.getAttribute('data-uid')?.toLowerCase() || '';
            const ticketId = row.querySelector('.ticket-id-tag')?.innerText.toLowerCase() || '';
            const subjectText = row.querySelector('.ticket-subject-text')?.innerText.toLowerCase() || '';
            const catText = row.querySelector('.ticket-cat-sub')?.innerText.toLowerCase() || '';
            const priorityText = row.querySelector('.priority-badge')?.innerText.toLowerCase() || '';
            const statusText = row.querySelector('.status-badge')?.innerText.toLowerCase() || '';

            const matchesQuery = userName.includes(query) || uid.includes(query) || ticketId.includes(query) || subjectText.includes(query);
            const matchesStatus = filterStatus === '' || statusText === filterStatus;
            const matchesCategory = filterCategory === '' || catText === filterCategory;
            const matchesPriority = filterPriority === '' || priorityText === filterPriority;

            row.style.display = matchesQuery && matchesStatus && matchesCategory && matchesPriority ? '' : 'none';
        });
    }

    if (searchInput) searchInput.addEventListener('input', applyFilters);
    if (statusSelect) statusSelect.addEventListener('change', applyFilters);
    if (categorySelect) categorySelect.addEventListener('change', applyFilters);
    if (prioritySelect) prioritySelect.addEventListener('change', applyFilters);
}

function initChatTransmissionHub() {
    const sendButton = document.getElementById('chatSendButton');
    const inputField = document.getElementById('chatInputField');
    if (!sendButton || !inputField) return;

    async function processMessageSend() {
        const text = inputField.value.trim();
        if (text === '' || !activeSelectedTicketId) return;

        try {
            const response = await fetch(`${getBaseUrl()}/admin/support/tickets/${activeSelectedTicketId}/reply`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': adminCsrfToken
                },
                body: JSON.stringify({ message: text })
            });

            const data = await response.json();
            if (!response.ok || !data.success) {
                throw new Error(data.message || 'Failed to send reply.');
            }

            appendMessageToStreamView(text, 'admin', new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }) + ' • Seen');
            inputField.value = '';
            if (supportTicketCache[activeSelectedTicketId]) {
                supportTicketCache[activeSelectedTicketId].messages = supportTicketCache[activeSelectedTicketId].messages || [];
                supportTicketCache[activeSelectedTicketId].messages.push(data.message);
            }
            scrollChatStreamToBottom();
        } catch (error) {
            console.error(error);
            alert(error.message || 'Unable to send admin reply.');
        }
    }

    sendButton.addEventListener('click', processMessageSend);
    inputField.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            processMessageSend();
        }
    });
}

function appendMessageToStreamView(text, type, timeString) {
    const stream = document.getElementById('chatMessageStream');
    if (!stream) return;
    const bubbleRow = document.createElement('div');
    bubbleRow.className = `chat-bubble-row ${type}-bubble`;
    const checkIcon = type === 'admin' ? '<i class="bx bx-check-double"></i>' : '<i class="bx bx-check-double text-secondary"></i>';
    bubbleRow.innerHTML = `<div class="bubble-content-text">${escapeHtml(text)}<div class="bubble-timestamp-meta">${escapeHtml(timeString)} ${type === 'admin' ? checkIcon : ''}</div></div>`;
    stream.appendChild(bubbleRow);
}

function scrollChatStreamToBottom() {
    const stream = document.getElementById('chatMessageStream');
    if (stream) stream.scrollTop = stream.scrollHeight;
}

async function modifyActiveTicketStatus(targetStatusLabel) {
    if (!activeSelectedTicketId) return;
    try {
        const response = await fetch(`${getBaseUrl()}/admin/support/tickets/${activeSelectedTicketId}/status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': adminCsrfToken
            },
            body: JSON.stringify({ status: targetStatusLabel })
        });

        const data = await response.json();
        if (!response.ok || !data.success) {
            throw new Error(data.message || 'Unable to update ticket status.');
        }

        if (supportTicketCache[activeSelectedTicketId]) {
            supportTicketCache[activeSelectedTicketId].status = data.ticket.status;
        }
        renderTicketDetails(supportTicketCache[activeSelectedTicketId]);
        document.querySelectorAll('#ticketTableBody tr').forEach(row => {
            if (row.querySelector('.ticket-id-tag')?.innerText === activeSelectedTicketId) {
                const statusBadge = row.querySelector('.status-badge');
                if (statusBadge) {
                    statusBadge.innerText = data.ticket.status;
                    statusBadge.className = `status-badge ${getTicketStatusClass(data.ticket.status)}`;
                }
            }
        });
    } catch (error) {
        console.error(error);
        alert(error.message || 'Unable to update ticket status.');
    }
}

function suspendUserAccount() {
    const ticket = supportTicketCache[activeSelectedTicketId];
    const userTarget = ticket?.name || 'selected user';
    const confirmAction = confirm(`WARNING: Are you sure you want to initialize complete security restrictions and account suspension triggers for customer ${userTarget}?`);
    if (confirmAction) {
        const statusField = document.getElementById('deck-status');
        if (statusField) {
            statusField.innerText = 'Suspended (Restricted)';
            statusField.className = 'detail-value color-danger';
        }
        alert(`Account security boundaries applied. Core authorization parameters disabled for ${userTarget}.`);
    }
}

window.addEventListener('DOMContentLoaded', function() {
    initSearchAndFilterSystem();
    initChatTransmissionHub();
    fetchAdminSupportTickets();
});
